<?php
namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use triguk\AuthorizationBundle\Entity\AuthObject;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

class LoadAuthObjectData extends AbstractFixture implements OrderedFixtureInterface,ContainerAwareInterface
{
    use ContainerAwareTrait;

    
    public function load(ObjectManager $manager)
    {

        $objects=[
            [
                'title'=>'AppBundle:User',
                'description'=>'Пользователи',
                'titleSingular'=>'Пользователь',
                'titlePlural'=>'Пользователи',
                'route'=>'user_index'
            ],
            [
                'title'=>'AppBundle:Machine',
                'description'=>'Аппаратный комплекс, содержащий один или несколько модулей с сенсорами',
                'titleSingular'=>'Аппаратный комплекс',
                'titlePlural'=>'Аппаратные комплексы',
                'route'=>'machine_index'
            ],
            [
                'title'=>'AppBundle:SensorType',
                'description'=>'Типы сенсоров',
                'titleSingular'=>'Тип сенсора',
                'titlePlural'=>'Типы сенсоров',
                'route'=>'sensor_type_index'
            ],
            [
                'title'=>'AppBundle:Sensor',
                'description'=>'Сенсор, реагирующий на различные изменения в окружающей среде',
                'titleSingular'=>'Сенсор',
                'titlePlural'=>'Сенсоры',
                'route'=>'sensor_index'
            ],
            [
                'title'=>'AppBundle:MachineStatus',
                'description'=>'Состояния аппаратных комплексов',
                'titleSingular'=>'Состояние аппаратного комплекса',
                'titlePlural'=>'Состояния аппаратных комплексов',
                'route'=>'machine_status_index'
            ],
            [
                'title'=>'AppBundle:SensorStatus',
                'description'=>'Состояния сенсоров',
                'titleSingular'=>'Состояние сенсора',
                'titlePlural'=>'Состояния сенсоров',
                'route'=>'sensor_status_index'
            ],
        ];
        
        foreach ($objects as $object)
        {
            $permission = new AuthObject();
            $permission->setName($object['title']);
            $permission->setDescription($object['description']);
            $permission->setTitleSingular($object['titleSingular']);
            $permission->setTitlePlural($object['titlePlural']);
            $permission->setRoute($object['route']);
            $manager->persist($permission);
        }   
        //$authObjectUser=$manager->getRepository(AuthObject::class)->findOneByName('AppBundle:User');
        
        $manager->flush();
    }
    
    public function getOrder()
    {
        return 2;
    }      
}
