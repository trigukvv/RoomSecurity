<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use AppBundle\Entity\MachineStatus;

class LoadMachineStatusData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    
    public function load(ObjectManager $manager)
    {
        $allMachineStatusValues=
        [
            [
                'machine'=>$this->getReference('machine1'),
                'alarmEnabled'=>false,
                'alarmTriggered'=>false,
                'isRequest'=>false,
                'publicCode'=>sha1(rand(100000,900000)),
                'createdAt'=>new \DateTime()
            ],

        ];
        foreach ($allMachineStatusValues as $machineStatusValues)
        {
            $machineStatus = new MachineStatus();
            $machineStatus->setMachine($machineStatusValues['machine']);
            $machineStatus->setAlarmEnabled($machineStatusValues['alarmEnabled']);
            $machineStatus->setAlarmTriggered($machineStatusValues['alarmTriggered']);
            $machineStatus->setIsRequest($machineStatusValues['isRequest']);
            $machineStatus->setPublicCode($machineStatusValues['publicCode']);
            $machineStatus->setCreatedAt($machineStatusValues['createdAt']);
            $manager->persist($machineStatus);
            $manager->flush();

        }

        $manager->flush();

    }
    
    public function getOrder()
    {

        return 102;
    }
}
