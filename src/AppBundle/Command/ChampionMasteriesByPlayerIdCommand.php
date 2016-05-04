<?php
namespace AppBundle\Command;

use AppBundle\Entity\ParticipantTimelineData;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ChampionMasteriesByPlayerIdCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('champion-masteries:by-player-id')
            ->setDescription('Import champion masteries for a given player ID')
            ->addArgument(
                'region',
                InputArgument::REQUIRED,
                'Region the player is from'
            )
            ->addArgument(
                'playerId',
                InputArgument::REQUIRED,
                'Player ID'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $regionId = $input->getArgument('region');
        $playerId = $input->getArgument('playerId');

        $championMasteryApi = $this->getContainer()->get('riot.api.champion_mastery');
        $masteries = $championMasteryApi->getMasteriesByPlayerId($regionId, $playerId);
        if (!is_array($masteries)) {
            dump($masteries);
        }
    }
}