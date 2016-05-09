<?php
namespace AppBundle\Command;

use AppBundle\Entity\ParticipantTimelineData;
use AppBundle\Entity\ViableRole;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ComputeViableRolesCommand extends ContainerAwareCommand
{
    const ROLE_VIABILITY_THRESHOLD = 0.1;

    protected function configure()
    {
        $this
            ->setName('compute:viable-roles')
            ->setDescription('Compute a set of most viable roles for champions');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $entityManager = $this->getContainer()->get('doctrine.orm.entity_manager');
        $championRepository = $entityManager->getRepository('AppBundle:Champion');
        $viableRoleRepository = $entityManager->getRepository('AppBundle:ViableRole');
        foreach ($championRepository->getChampionKeys() as $championKey) {
            $roleDistributions = $championRepository->getRoles($championKey['key']);
            $totalGames = 0;
            foreach ($roleDistributions as $roleDistribution) {
                $totalGames += $roleDistribution['roleCount'];
            }
            $roles = $viableRoleRepository->findBy(['key' => $championKey['key']]);
            foreach ($roleDistributions as $roleDistribution) {
                if ($roleDistribution['lane'] && $roleDistribution['role']
                    && $roleDistribution['roleCount'] / $totalGames >= self::ROLE_VIABILITY_THRESHOLD
                ) {
                    $viableRole = null;
                    foreach ($roles as $i => $role) {
                        if ($role->getLane() == $roleDistribution['lane']
                            && $role->getRole() == $roleDistribution['role']
                        ) {
                            $viableRole = $role;
                            unset($roles[$i]);
                            break;
                        }
                    }
                    if (!$viableRole) {
                        $viableRole = new ViableRole();
                        $viableRole->setKey($championKey['key'])
                            ->setLane($roleDistribution['lane'])
                            ->setRole($roleDistribution['role']);
                        $entityManager->persist($viableRole);
                    }
                }
            }
            foreach ($roles as $role) {
                $entityManager->remove($role);
            }
        }
        $entityManager->flush();
    }
}