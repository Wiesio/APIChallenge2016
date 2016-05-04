<?php
namespace AppBundle\Command;

use AppBundle\Entity\MatchDetail;
use AppBundle\Entity\ParticipantTimelineData;
use AppBundle\Entity\Player;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class FetchDataCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('fetch:data')
            ->setDescription('Import various player and match information into database.')
            ->addArgument(
                'region',
                InputArgument::REQUIRED
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $regionId = $input->getArgument('region');
        $entityManager = $this->getContainer()->get('doctrine.orm.entity_manager');
        $playerRepository = $entityManager->getRepository('AppBundle:Player');
        $player = $playerRepository->findPlayerWithoutMatch($regionId);
        if ($player) {
//            dump($player);
            $matchListApi = $this->getContainer()->get('riot.api.match_list');
            $matchListApi->getMatchListByPlayerId($regionId, $player->getSummonerId());
        }
        $matchReferenceRepository = $entityManager->getRepository('AppBundle:MatchReference');
        $matchReference = $matchReferenceRepository->getLatestEmptyReference($regionId);
        if ($matchReference) {
//            dump($matchReference);
            $matchApi = $this->getContainer()->get('riot.api.match');
            $matchDetail = $matchApi->getMatch($regionId, $matchReference->getMatchId());
            if ($matchDetail instanceof MatchDetail) {
//                dump($matchDetail->getMatchId());
                $matchListApi = $this->getContainer()->get('riot.api.match_list');
                $options = [
                    'rankedQueues' => ['TEAM_BUILDER_DRAFT_RANKED_5x5'],
                    'beginIndex' => 0,
                    'endIndex' => 10,
                ];
                foreach ($matchDetail->getParticipants() as $participant) {
                    if ($player = $participant->getPlayer()) {
//                        dump($player);
                        $matchListApi->getMatchListByPlayerId($regionId, $player->getSummonerId(), $options);
                    }
                }

            }
        }
    }
}
