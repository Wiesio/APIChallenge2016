<?php
namespace AppBundle\Command;

use AppBundle\Entity\ParticipantTimelineData;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ChampionsAllCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('champions:all')
            ->setDescription('Import champions')
            ->addArgument(
                'region',
                InputArgument::REQUIRED,
                'Region ID'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $regionId = $input->getArgument('region');

        $championApi = $this->getContainer()->get('riot.api.champion');
        $champions = $championApi->getChampions($regionId);
        if (!is_array($champions)) {
            dump($champions);
        }
    }
}