<?php
namespace AppBundle\Command;

use AppBundle\Entity\ParticipantTimelineData;
use AppBundle\Entity\Player;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SummonersByNamesCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('summoners:by-names')
            ->setDescription('Import summoners for a given list of comma-separated names')
            ->addArgument(
                'region',
                InputArgument::REQUIRED,
                'Region the summoners are from'
            )
            ->addArgument(
                'names',
                InputArgument::REQUIRED,
                'List of comma-separated summoner names'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $regionId = $input->getArgument('region');
        $names = $input->getArgument('names');
        $names = explode(',', $names);

        $entityManager = $this->getContainer()->get('doctrine.orm.entity_manager');
        $playerRepository = $entityManager->getRepository('AppBundle:Player');
        $foundPlayers = $playerRepository->findBy([
            'region' => $regionId,
            'summonerName' => $names,
        ]);

        foreach ($foundPlayers as $player) {
            if (($idx = array_search($player->getSummonerName(), $names)) !== false) {
                unset($names[$idx]);
            }
        }

        $summonerApi = $this->getContainer()->get('riot.api.summoner');
        $players = $summonerApi->getSummonersByNames($regionId, $names);
        if (!is_array($players)) {
            dump($players);
        }
    }
}