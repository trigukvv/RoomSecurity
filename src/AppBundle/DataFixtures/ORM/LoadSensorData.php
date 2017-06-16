<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use AppBundle\Entity\Sensor;

class LoadSensorData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
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
        $allSensorValues=
        [
            [
                'title'=>'Датчик открытия входной двери',
                'description'=>'Срабатывает при открытии входной двери',
                'sensorType'=>$this->getReference('sensorType1'),
                'machine'=>$this->getReference('machine1'),
            ],
            [
                'title'=>'Датчик бытового газа и дыма',
                'description'=>'Расположен на кухне и фиксирует там ЧП для МЧС и газовой аварийной службы',
                'sensorType'=>$this->getReference('sensorType2'),
                'machine'=>$this->getReference('machine1'),
            ],
            [
                'title'=>'Датчик открытия балконной двери',
                'description'=>'Срабатывает при открытии балконной двери',
                'sensorType'=>$this->getReference('sensorType1'),
                'machine'=>$this->getReference('machine1'),
            ],
        ];
        $c=0;
        foreach ($allSensorValues as $sensorValues)
        {
            $sensor = new Sensor();
            $sensor->setTitle($sensorValues['title']);
            $sensor->setDescription($sensorValues['description']);
            $sensor->setSensorType($sensorValues['sensorType']);
            $sensor->setMachine($sensorValues['machine']);
            $manager->persist($sensor);
            $manager->flush();
            $c++;
            $this->addReference("sensor$c", $sensor);
        }

        $manager->flush();

    }
    
    public function getOrder()
    {

        return 103;
    }
}
