<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use AppBundle\Entity\SensorType;

class LoadSensorTypeData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
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
        $allSensorTypeValues=
        [
            [
                'title'=>'Датчик расстояния',
                'description'=>'Фиксирует факт открытия двери или окна',
            ],
            [
                'title'=>'Датчик газа',
                'description'=>'Фиксирует превышение концентрации бытового газа, дыма',
            ],
        ];
        $c=0;
        foreach ($allSensorTypeValues as $sensorTypeValues)
        {
            $sensorType = new SensorType();
            $sensorType->setTitle($sensorTypeValues['title']);
            $sensorType->setDescription($sensorTypeValues['description']);
            $manager->persist($sensorType);
            $manager->flush();
            $c++;
            $this->addReference("sensorType$c", $sensorType);
        }

        $manager->flush();

    }
    
    public function getOrder()
    {

        return 101;
    }
}
