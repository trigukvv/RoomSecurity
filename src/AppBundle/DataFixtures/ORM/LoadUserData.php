<?php
namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use triguk\AuthorizationBundle\Entity\AuthRole;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

use AppBundle\Entity\User;

class LoadUserData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
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
        
        //$companies=$this->getReference('Йоулупукки-Инвест');
        
        //$companyRepository=$this->container->get('doctrine')->getRepository('AppBundle:Company');
        $roleAdmin=$manager->getRepository(AuthRole::class)->findOneByName('admin');
        
        $users = 
        [
			[
				'username'=>'admin',
				'password'=>'pass',
				'email'=>'admin@admin.ca',
				'isActive'=>true,
				'authRoles'=>[$roleAdmin],
			],
			
			//----------------------------------------------------------
			[
				'username'=>'demidchik',
				'password'=>'pass',
				'lastName'=>'Пачкин',
				'email'=>'stalker3_81@mail.ru',
				'isActive'=>true,
				'authRoles'=>[],
			],
			
			
		];
        
        foreach ($users as $user){
				$userObject = new User();
				$userObject->setUsername($user['username']);
				$userObject->setPassword(password_hash($user['password'], PASSWORD_BCRYPT));
				$userObject->setEmail($user['email']);
				
				$userObject->setIsActive($user['isActive']);
				

				
				$manager->persist($userObject);
				foreach ($user['authRoles'] as $authRole)
				{
					$userObject->addAuthRole($authRole);
				}
                $this->addReference($user['username'],$userObject);
               
        }
        $manager->flush();
        
        
        
    }
    
    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 101;
    }
}
