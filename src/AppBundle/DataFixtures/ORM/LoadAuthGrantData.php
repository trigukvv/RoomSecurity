<?php
namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use triguk\AuthorizationBundle\Entity\AuthObject;
use triguk\AuthorizationBundle\Entity\AuthPermission;
use triguk\AuthorizationBundle\Entity\AuthGrant;
use triguk\AuthorizationBundle\Entity\AuthRole;
use triguk\AuthorizationBundle\Entity\AuthScope;


class LoadAuthGrantData extends AbstractFixture implements OrderedFixtureInterface,ContainerAwareInterface
{
    use ContainerAwareTrait;
    private $bundleName,$userEntity;
    
    public function load(ObjectManager $manager)
    {
        $grantRepository=$manager->getRepository(AuthGrant::class);
        $scopeRepository=$manager->getRepository(AuthScope::class);        
        $permissionRepository=$manager->getRepository(AuthPermission::class);  
        $roleRepository=$manager->getRepository(AuthRole::class);  
        $objectRepository=$manager->getRepository(AuthObject::class);
                
        $roleAdmin=$roleRepository->findOneByName('user');
/*
        $objectArticle=$objectRepository->findOneByName('AppBundle:Article');
        $objectComment=$objectRepository->findOneByName('AppBundle:Comment');
        $scopeOwner=$scopeRepository->findOneByName('owner');
        
        $allPermissions=$permissionRepository->findAll();
        
        $createPermission=$permissionRepository->findOneByName('create');

        
        $grantRepository->syncRoleObjectScopeGrants(
            $roleUser,$objectArticle,$scopeOwner,$allPermissions
        );
        $grantRepository->syncRoleObjectScopeGrants(
            $roleUser,$objectComment,$scopeOwner,$allPermissions
        );
        
        $scopeAll=$scopeRepository->findOneByName('all');
        
        $grantRepository->syncRoleObjectScopeGrants(
            $roleUser,$objectArticle,$scopeAll,[$createPermission]
        );
        $grantRepository->syncRoleObjectScopeGrants(
            $roleUser,$objectComment,$scopeAll,[$createPermission]
        );
                
        $roleModerator=$roleRepository->findOneByName('moderator');

        $scopeGroup=$scopeRepository->findOneByName('group');
        

        
        $allPermissions=$permissionRepository->findAll();
        
        $grantRepository->syncRoleObjectScopeGrants(
            $roleModerator,$objectArticle,$scopeGroup,$allPermissions
        );
        $grantRepository->syncRoleObjectScopeGrants(
            $roleModerator,$objectComment,$scopeGroup,$allPermissions
        );
        
        $user2=$this->getReference('user2');
        
        $user2->addAuthRole($roleModerator);
*/
    }
    
    public function getOrder()
    {
        return 1010;
    }      
}
