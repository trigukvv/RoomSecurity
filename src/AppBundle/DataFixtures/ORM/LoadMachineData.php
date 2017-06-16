<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use AppBundle\Entity\Machine;

class LoadMachineData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
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
        $allMachineValues=
        [
            [
                'title'=>'Система безопасности для квартиры [classified]',
                'description'=>'Система из головного (принимающего) модуля и двух передающих, расположенная по адресу [classified]',
                'securityCode'=>'f1a681883853b852558a167e40dbda1e93b40dd1',
                'user'=>$this->getReference('demidchik')
            ],

        ];
        $c=0;
        foreach ($allMachineValues as $machineValues)
        {
            $machine = new Machine();
            $machine->setTitle($machineValues['title']);
            $machine->setDescription($machineValues['description']);
            $machine->setSecurityCode($machineValues['securityCode']);
            $machine->setUser($machineValues['user']);
            $manager->persist($machine);
            $manager->flush();
            $c++;
            $this->addReference("machine$c", $machine);
        }

        $manager->flush();

    }
    
    public function getOrder()
    {

        return 102;
    }
}
