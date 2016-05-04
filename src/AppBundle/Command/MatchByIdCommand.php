<?php
namespace AppBundle\Command;

use AppBundle\Entity\MatchDetail;
use AppBundle\Entity\ParticipantTimelineData;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MatchByIdCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('match:by-id')
            ->setDescription('Import match for a given ID')
            ->addArgument(
                'region',
                InputArgument::REQUIRED,
                'Region the match is from'
            )
            ->addArgument(
                'id',
                InputArgument::REQUIRED,
                'Match ID'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $regionId = $input->getArgument('region');
        $matchId = $input->getArgument('id');

        $entityManager = $this->getContainer()->get('doctrine.orm.entity_manager');
        $matchDetailRepository = $entityManager->getRepository('AppBundle:MatchDetail');
        if (!$matchDetailRepository->findBy([
            'region' => $regionId,
            'matchId' => $matchId,
        ])
        ) {
            $matchApi = $this->getContainer()->get('riot.api.match');
            $matchDetail = $matchApi->getMatch($regionId, $matchId);
            if (!$matchDetail instanceof MatchDetail) {
                dump($matchDetail);
            }
        }
    }
}