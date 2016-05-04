<?php
namespace AppBundle\Command;

use AppBundle\Entity\ParticipantTimelineData;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class MatchListByPlayerIdCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('match-list:by-player-id')
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
            )
            ->addOption(
                'championIds',
                null,
                InputOption::VALUE_REQUIRED | InputOption::VALUE_IS_ARRAY,
                'Champion IDs'
            )
            ->addOption(
                'rankedQueues',
                null,
                InputOption::VALUE_REQUIRED | InputOption::VALUE_IS_ARRAY,
                'Ranked queue types'
            )
            ->addOption(
                'seasons',
                null,
                InputOption::VALUE_REQUIRED | InputOption::VALUE_IS_ARRAY,
                'Seasons'
            )
            ->addOption(
                'beginTime',
                null,
                InputOption::VALUE_REQUIRED,
                'Begin time'
            )
            ->addOption(
                'endTime',
                null,
                InputOption::VALUE_REQUIRED,
                'End time'
            )
            ->addOption(
                'beginIndex',
                null,
                InputOption::VALUE_REQUIRED,
                'Begin index'
            )
            ->addOption(
                'endIndex',
                null,
                InputOption::VALUE_REQUIRED,
                'End index'
            );

    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $regionId = $input->getArgument('region');
        $playerId = $input->getArgument('playerId');
        $options = [];

        if ($option = $input->getOption('championIds')) {
            $options['championIds'] = $option;
        }
        if ($option = $input->getOption('rankedQueues')) {
            $options['rankedQueues'] = $option;
        }
        if ($option = $input->getOption('seasons')) {
            $options['seasons'] = $option;
        }
        if ($option = $input->getOption('beginTime')) {
            $options['beginTime'] = new \DateTime($option);
        }
        if ($option = $input->getOption('endTime')) {
            $options['endTime'] = new \DateTime($option);
        }
        if ($option = $input->getOption('beginIndex')) {
            $options['beginIndex'] = (int)$option;
        }
        if ($option = $input->getOption('endIndex')) {
            $options['endIndex'] = (int)$option;
        }

        $matchListApi = $this->getContainer()->get('riot.api.match_list');
        $matches = $matchListApi->getMatchListByPlayerId($regionId, $playerId, $options);
        if (!is_array($matches)) {
            dump($matches);
        }
    }
}
