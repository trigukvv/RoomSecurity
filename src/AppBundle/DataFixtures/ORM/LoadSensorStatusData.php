<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use AppBundle\Entity\SensorStatus;

class LoadSensorStatusData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
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
        $allSensorStatusValues=
        [
            [
                'sensor'=>$this->getReference('sensor1'),
                'alarmTriggered'=>false,
                'createdAt'=>new \DateTime()
            ],
            [
                'sensor'=>$this->getReference('sensor2'),
                'alarmTriggered'=>false,
                'createdAt'=>new \DateTime()
            ],
            [
                'sensor'=>$this->getReference('sensor3'),
                'alarmTriggered'=>false,
                'createdAt'=>new \DateTime()
            ],
        ];
        foreach ($allSensorStatusValues as $sensorStatusValues)
        {
            $sensorStatus = new SensorStatus();
            $sensorStatus->setSensor($sensorStatusValues['sensor']);
            $sensorStatus->setAlarmTriggered($sensorStatusValues['alarmTriggered']);
            $sensorStatus->setCreatedAt($sensorStatusValues['createdAt']);
            $manager->persist($sensorStatus);
            $manager->flush();

        }

        $manager->flush();

    }
    
    public function getOrder()
    {

        return 104;
    }
}
