<?php

namespace AppBundle\Controller;

use AppBundle\Entity\ChampionMastery;
use AppBundle\Entity\ParticipantTimelineData;
use AppBundle\Entity\Player;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/api")
 */
class ApiController extends Controller
{
    const PLAYER_PICKS_COUNT = 10;

    /**
     * @Method("GET")
     * @Route("/getRegions.json", name="api_get_regions")
     * @return JsonResponse
     */
    public function getRegionsAction()
    {
        $response = [
            [
                'id' => 'eune',
                'name' => 'Europe Nordic&East'
            ],
            [
                'id' => 'euw',
                'name' => 'Europe West'
            ],
            [
                'id' => 'na',
                'name' => 'North America'
            ],
        ];

        return new JsonResponse($response);
    }

    /**
     * @Method("POST")
     * @Route("/getUser.json", name="api_get_user")
     * @param Request $request
     * @return JsonResponse
     */
    public function getUserAction(Request $request)
    {
        $data = json_decode($request->getContent());
        $player = null;
        if(property_exists($data, 'name') && property_exists($data, 'region')) {
            $playerRepository = $this->getDoctrine()->getRepository('AppBundle:Player');
            $player = $playerRepository->findOneBy(['summonerName' => $data->name, 'region' => $data->region]);
            if(!$player) {
                $summonerApi = $this->get('riot.api.summoner');
                $players = $summonerApi->getSummonersByNames($data->region, [$data->name]);
                if(is_array($players)) {
                    $player = current($players);
                }
            }
        }
        $statusCode = 200;
        if($player) {
            $response = [
                'user' => $player->getSummonerId(),
                'region' => $player->getRegion()
            ];
        } else {
            $statusCode = 404;
            $response = [
                'error' => 'Summoner not found.'
            ];
        }

        return new JsonResponse($response, $statusCode);
    }

    /**
     * @Method("POST")
     * @Route("/getUserPicks.json", name="api_get_user_picks")
     * @param Request $request
     * @return JsonResponse
     */
    public function getUserPicksAction(Request $request)
    {
        $data = json_decode($request->getContent());
        $player = null;
        /** @var ChampionMastery[] $championMasteries */
        $championMasteries = [];
        if(property_exists($data, 'id') && property_exists($data, 'region')) {
            $playerRepository = $this->getDoctrine()->getRepository('AppBundle:Player');
            $player = $playerRepository->findOneBy(['summonerId' => $data->id, 'region' => $data->region]);
            if(!$player) {
                $summonerApi = $this->get('riot.api.summoner');
                $players = $summonerApi->getSummonersByIds($data->region, [$data->id]);
                if(is_array($players)) {
                    /** @var Player $player */
                    $player = current($players);
                }
            }
            if($player) {
                $championMasteryApi = $this->get('riot.api.champion_mastery');
                $championMasteries =
                    $championMasteryApi->getMasteriesByPlayerId($player->getRegion(), $player->getSummonerId());
            }
        }
        $response = [];
        $count = min(count($championMasteries), self::PLAYER_PICKS_COUNT);
        for($i = 0; $i < $count; $i++) {
            $champion = $championMasteries[$i]->getChampion();
            $response[] = [
                'id' => $champion->getChampionId(),
                'champion' => $champion->getName(),
                'title' => $champion->getTitle(),
                'image' => $champion->getImage(),
            ];
        }

        return new JsonResponse($response);
    }

    /**
     * @Method("GET")
     * @Route("/getSuggestedBans.json", name="api_get_suggested_bans")
     * @return JsonResponse
     */
    public function getSuggestedBansAction()
    {
        $championRepository = $this->getDoctrine()->getRepository('AppBundle:Champion');
        $bans = $championRepository->getMostPopularBans();
        $response = [];
        foreach($bans as $ban) {
            $response[] = [
                'id' => $ban->getChampionId(),
                'champion' => $ban->getName(),
                'title' => $ban->getTitle(),
                'image' => $ban->getImage(),
            ];
        }

        return new JsonResponse($response);
    }
}
