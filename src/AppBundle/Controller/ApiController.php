<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Champion;
use AppBundle\Entity\ParticipantTimelineData;
use AppBundle\Entity\Player;
use AppBundle\Entity\ViableRole;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

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
        if (property_exists($data, 'name') && property_exists($data, 'region')) {
            $playerRepository = $this->getDoctrine()->getRepository('AppBundle:Player');
            $player = $playerRepository->findOneBy(['summonerName' => $data->name, 'region' => $data->region]);
            if (!$player) {
                $summonerApi = $this->get('riot.api.summoner');
                $players = $summonerApi->getSummonersByNames($data->region, [$data->name]);
                if (is_array($players)) {
                    /** @var Player $player */
                    $player = current($players);
                }
            }
            if ($player && !$player->getChampionMasteries()->count()) {
                dump($this->get('riot.api.champion_mastery')
                    ->getMasteriesByPlayerId($data->region, $player->getSummonerId()));
            }
        }
        $statusCode = 200;
        if ($player) {
            $response = [
                'user' => $player->getId(),
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
        $response = [];
        if (property_exists($data, 'bans') && property_exists($data, 'allyPicks')
            && property_exists($data, 'enemyPicks') && property_exists($data, 'userRole')
            && property_exists($data, 'user') && is_object($data->user)
            && property_exists($data->user, 'region') && property_exists($data->user, 'id')
        ) {
            $unavailableChampionIds = [];
            if (is_array($data->bans)) {
                $unavailableChampionIds = array_merge($unavailableChampionIds, $data->bans);
            }
            if (is_array($data->allyPicks)) {
                $unavailableChampionIds += array_merge($unavailableChampionIds, $data->allyPicks);
            }
            if (is_array($data->enemyPicks)) {
                $unavailableChampionIds += array_merge($unavailableChampionIds, $data->enemyPicks);
            }
            $championRepository = $this->getDoctrine()->getRepository('AppBundle:Champion');
            $playerRepository = $this->getDoctrine()->getRepository('AppBundle:Player');
            $viableRoleRepository = $this->getDoctrine()->getRepository('AppBundle:ViableRole');
            $player = $playerRepository->find($data->user->id);
            /** @var Champion[] $availableChampions */
            $availableChampions = [];
            foreach ($player->getChampionMasteries() as $championMastery) {
                if (!in_array($championMastery->getChampion()->getId(), $unavailableChampionIds)) {
                    if (!$data->userRole) {
                        $availableChampions[] = $championMastery->getChampion();
                    } else {
                        $champion = $championMastery->getChampion();
                        /** @var ViableRole[] $viableRoles */
                        $viableRoles = $viableRoleRepository->findBy(['key' => $champion->getKey()]);
                        $roleParts = explode('-', $data->userRole);
                        foreach ($viableRoles as $viableRole) {
                            if ($viableRole->getLane() == $roleParts[0] && $viableRole->getRole() == $roleParts[1]) {
                                $availableChampions[] = $champion;
                            }
                        }
                    }
                }
            }
            $unavailableChampions = [];
            foreach ($championRepository->findBy(['region' => $data->user->region, 'id' => $unavailableChampionIds]) as $champion) {
                $unavailableChampions[$champion->getId()] = $champion;
            }
            $matchDetailRepository = $this->getDoctrine()->getRepository('AppBundle:MatchDetail');
            $pickCount = min(count($availableChampions), self::PLAYER_PICKS_COUNT);
            for ($i = 0; $i < $pickCount; $i++) {
                $champion = $availableChampions[$i];
                $matchesWon = 0;
                $matchesLost = 0;
                $isAlly = $matchWon = true;
                $isEnemy = $matchLost = false;
                foreach ($data->allyPicks as $allyPick) {
                    $matchesWon += $matchDetailRepository->getMatchStatistics(
                        $champion->getKey(),
                        $unavailableChampions[$allyPick]->getKey(),
                        $isAlly,
                        $matchWon
                    );
                }
                foreach ($data->allyPicks as $allyPick) {
                    $matchesLost += $matchDetailRepository->getMatchStatistics(
                        $champion->getKey(),
                        $unavailableChampions[$allyPick]->getKey(),
                        $isAlly,
                        $matchLost
                    );
                }
                foreach ($data->enemyPicks as $enemyPick) {
                    $matchesWon += $matchDetailRepository->getMatchStatistics(
                        $champion->getKey(),
                        $unavailableChampions[$enemyPick]->getKey(),
                        $isEnemy,
                        $matchWon
                    );
                }
                foreach ($data->enemyPicks as $enemyPick) {
                    $matchesLost += $matchDetailRepository->getMatchStatistics(
                        $champion->getKey(),
                        $unavailableChampions[$enemyPick]->getKey(),
                        $isEnemy,
                        $matchLost
                    );
                }
                $matchCount = $matchesLost + $matchesWon;
                $winRatio = $matchCount ? ($matchesWon / $matchCount) : 0.5;
                $level = 0;
                foreach ($player->getChampionMasteries() as $championMastery) {
                    if ($championMastery->getChampion() == $champion) {
                        $level = $championMastery->getChampionLevel();
                    }
                }
                $response[] = [
                    'id' => $champion->getId(),
                    'champion' => $champion->getName(),
                    'title' => $champion->getName() . ', ' . $champion->getTitle(),
                    'image' => $champion->getImage(),
                    'winRatio' => $winRatio,
                    'level' => $level,
                ];
            }
        }
        return new JsonResponse($response);
    }

    /**
     * @Method("POST")
     * @Route("/getSuggestedBans.json", name="api_get_suggested_bans")
     * @param Request $request
     * @return JsonResponse
     */
    public
    function getSuggestedBansAction(Request $request)
    {
        $data = json_decode($request->getContent());
        $response = [];
        if (property_exists($data, 'region')) {
            $championRepository = $this->getDoctrine()->getRepository('AppBundle:Champion');
            $bans = [];
            foreach ($championRepository->getMostPopularBans() as $ban) {
                $bans[$ban->getKey()] = $ban;
                }
            $regionalBans = [];
            foreach ($championRepository->findBy(['key' => array_keys($bans), 'region' => $data->region])
                     as $regionalBan) {
                $regionalBans[$regionalBan->getKey()] = $regionalBan;
            }
            foreach (array_keys($bans) as $key) {
                $ban = $regionalBans[$key];
                    $response[] = [
                        'id' => $ban->getId(),
                        'champion' => $ban->getName(),
                        'title' => $ban->getName() . ', ' . $ban->getTitle(),
                        'image' => $ban->getImage(),
                    ];
                }
        }

        return new JsonResponse($response);
    }

    /**
     * @Method("POST")
     * @Route("/getBans.json", name="api_get_bans")
     * @param Request $request
     * @return JsonResponse
     */
    public
    function getBanListAction(Request $request)
    {
        $data = json_decode($request->getContent());
        $response = [];
        if (property_exists($data, 'bans') && property_exists($data, 'user') && property_exists($data->user, 'region')) {
            $banIds = is_array($data->bans) ? $data->bans : [];
            $championRepository = $this->getDoctrine()->getRepository('AppBundle:Champion');
            $bans = $championRepository->getExcept($data->user->region, $banIds);
            foreach ($bans as $ban) {
                $response[] = [
                    'id' => $ban->getId(),
                    'champion' => $ban->getName(),
                    'title' => $ban->getName() . ', ' . $ban->getTitle(),
                    'image' => $ban->getImage(),
                ];
            }
        }

        return new JsonResponse($response);
    }

    /**
     * @Method("POST")
     * @Route("/getPicks.json", name="api_get_picks")
     * @param Request $request
     * @return JsonResponse
     */
    public
    function getPicksAction(Request $request)
    {
        $data = json_decode($request->getContent());
        $response = [];
        if (property_exists($data, 'bans') && property_exists($data, 'allyPicks')
            && property_exists($data, 'enemyPicks') && property_exists($data, 'user')
            && is_object($data->user) && property_exists($data->user, 'region')
        ) {
            $unavailableChampionIds = [];
            if (is_array($data->bans)) {
                $unavailableChampionIds = array_merge($unavailableChampionIds, $data->bans);
            }
            if (is_array($data->allyPicks)) {
                $unavailableChampionIds += array_merge($unavailableChampionIds, $data->allyPicks);
            }
            if (is_array($data->enemyPicks)) {
                $unavailableChampionIds += array_merge($unavailableChampionIds, $data->enemyPicks);
            }
            $championRepository = $this->getDoctrine()->getRepository('AppBundle:Champion');
            $availableChampions = $championRepository->getExcept($data->user->region, $unavailableChampionIds);
                foreach ($availableChampions as $champion) {
                    $response[] = [
                        'id' => $champion->getId(),
                        'champion' => $champion->getName(),
                        'title' => $champion->getName() . ', ' . $champion->getTitle(),
                        'image' => $champion->getImage(),
                    ];
                }
            }

        return new JsonResponse($response);
    }
    }
