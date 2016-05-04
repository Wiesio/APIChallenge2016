<?php
namespace AppBundle\Riot;

use AppBundle\Entity\Champion;
use AppBundle\Entity\ParticipantTimelineData;
use Doctrine\ORM\EntityManagerInterface;

class ChampionApi
{
    /**
     * @var ApiRequestQueueCollection
     */
    protected $requestQueues;

    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;

    /**
     * @var StaticDataApi
     */
    protected $staticDataApi;

    public function __construct(ApiRequestQueueCollection $requestQueues,
                                EntityManagerInterface $entityManager,
                                StaticDataApi $staticDataApi)
    {
        $this->requestQueues = $requestQueues;
        $this->entityManager = $entityManager;
        $this->staticDataApi = $staticDataApi;
    }

    /**
     * @param $regionId
     * @return Champion[]|null
     */
    public function getChampions($regionId)
    {
        $url = sprintf('/api/lol/%s/v1.2/champion',
            $regionId
        );
        $response = $this->requestQueues->executeRequest($regionId, $url);

        if ($response && property_exists($response, 'statusCode') && $response->statusCode == 200
            && property_exists($response, 'data')
        ) {
            $championJsonObjects = json_decode($response->data);
        } else {
            return $response;
        }
        $championsStaticData = $this->staticDataApi->getChampions($regionId);
        if (is_array($championsStaticData)) {
            dump($championsStaticData);
            $championsStaticData = new \stdClass;
        }

        $champions = [];
        $result = [];
        $championRepository = $this->entityManager->getRepository('AppBundle:Champion');
        foreach ($championRepository->findBy(['region' => $regionId]) as $champion) {
            $champions[$champion->getChampionId()] = $champion;
        }
        if (isset($championJsonObjects->champions) && is_array($championJsonObjects->champions)) {
            foreach ($championJsonObjects->champions as $championJsonObj) {
                if (isset($championJsonObj->id)) {
                    if (array_key_exists($championJsonObj->id, $champions)) {
                        $champion = $champions[$championJsonObj->id];
                        unset($champions[$championJsonObj->id]);
                    } else {
                        $champion = new Champion();
                        $champion->setChampionId($championJsonObj->id)
                            ->setRegion($regionId);
                        $this->entityManager->persist($champion);
                    }
                    $champion->setActive($championJsonObj->id)
                        ->setBotMmEnabled(isset($championJsonObj->botMmEnabled)
                            ? $championJsonObj->botMmEnabled : null)
                        ->setRankedPlayEnabled(isset($championJsonObj->rankedPlayEnabled)
                            ? $championJsonObj->rankedPlayEnabled : null)
                        ->setBotEnabled(isset($championJsonObj->botEnabled)
                            ? $championJsonObj->botEnabled : null)
                        ->setActive(isset($championJsonObj->active)
                            ? $championJsonObj->active : null)
                        ->setFreeToPlay(isset($championJsonObj->freeToPlay)
                            ? $championJsonObj->freeToPlay : null);
                    if (property_exists($championsStaticData, $championJsonObj->id)) {
                        $championStaticData = $championsStaticData->{$championJsonObj->id};
                        $champion->setName(isset($championStaticData->name)
                            ? $championStaticData->name : null)
                            ->setTitle(isset($championStaticData->title)
                                ? $championStaticData->title : null)
                            ->setKey(isset($championStaticData->key)
                                ? $championStaticData->key : null)
                            ->setImage(isset($championStaticData->image)
                                ? $championStaticData->image : null);
                    }
                    $result[$champion->getChampionId()] = $champion;
                }
            }
        }
        foreach ($champions as $champion) {
            $this->entityManager->remove($champion);
        }
        $this->entityManager->flush();

        return $result;
    }
}
