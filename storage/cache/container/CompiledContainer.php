<?php
/**
 * This class has been auto-generated by PHP-DI.
 */
class CompiledContainer extends DI\CompiledContainer{
    const METHOD_MAPPING = array (
  'Psr\\Http\\Message\\ResponseFactoryInterface' => 'get1',
  'Symfony\\Component\\PasswordHasher\\Hasher\\UserPasswordHasherInterface' => 'get2',
  'Symfony\\Component\\PasswordHasher\\Hasher\\UserPasswordHasher' => 'get3',
  'Denosys\\App\\Services\\UserAuthenticationService' => 'get4',
  'Symfony\\Component\\Security\\Core\\Authentication\\Token\\Storage\\TokenStorageInterface' => 'get5',
  'Valitron\\Validator' => 'get6',
  'Denosys\\Core\\Encryption\\EncrypterInterface' => 'get7',
  'Symfony\\Component\\Security\\Core\\Authentication\\AuthenticationTrustResolverInterface' => 'get8',
  'Symfony\\Component\\Security\\Core\\Authorization\\AuthorizationCheckerInterface' => 'get9',
  'Denosys\\Core\\Security\\CurrentUser' => 'get10',
  'Symfony\\Component\\Security\\Core\\User\\UserProviderInterface' => 'get11',
);

    protected function get1()
    {
        return $this->resolveFactory(static fn () => new \Slim\Psr7\Factory\ResponseFactory(), 'Psr\\Http\\Message\\ResponseFactoryInterface');
    }

    protected function get2()
    {
        return $this->resolveFactory(static fn (\Psr\Container\ContainerInterface $container)
        => $container->get(\Symfony\Component\PasswordHasher\Hasher\UserPasswordHasher::class), 'Symfony\\Component\\PasswordHasher\\Hasher\\UserPasswordHasherInterface');
    }

    protected function get3()
    {
        return $this->resolveFactory(static fn ()
        => new \Symfony\Component\PasswordHasher\Hasher\UserPasswordHasher(new \Symfony\Component\PasswordHasher\Hasher\PasswordHasherFactory(
            [
                \Denosys\App\Database\Entities\User::class => new \Symfony\Component\PasswordHasher\Hasher\NativePasswordHasher(),
            ]
        )), 'Symfony\\Component\\PasswordHasher\\Hasher\\UserPasswordHasher');
    }

    protected function get4()
    {
        return $this->resolveFactory(static fn (\Psr\Container\ContainerInterface $container)
        => new \Denosys\App\Services\UserAuthenticationService(
            $container->get(\Doctrine\ORM\EntityManagerInterface::class),
            $container->get(\Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface::class),
            $container->get(\Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface::class),
            $container->get(\Symfony\Component\Security\Core\Authentication\AuthenticationTrustResolverInterface::class),
            $container->get(\Denosys\Core\Security\CurrentUser::class)
        ), 'Denosys\\App\\Services\\UserAuthenticationService');
    }

    protected function get5()
    {
        return $this->resolveFactory(static fn (\Psr\Container\ContainerInterface $container)
        => new \Denosys\Core\Security\EncryptedSessionTokenStorage(
            $container->get(\Denosys\Core\Encryption\EncrypterInterface::class),
            $container->get(\Denosys\Core\Session\SessionInterface::class),
            $container->get('config')->get('session.name')
        ), 'Symfony\\Component\\Security\\Core\\Authentication\\Token\\Storage\\TokenStorageInterface');
    }

    protected function get6()
    {
        return $this->resolveFactory(static fn () => new \Valitron\Validator(), 'Valitron\\Validator');
    }

    protected function get7()
    {
        return $this->resolveFactory(static fn (\Denosys\Core\Config\ConfigurationInterface $config)
        => new \Denosys\Core\Encryption\Encrypter($config->get('app.key')), 'Denosys\\Core\\Encryption\\EncrypterInterface');
    }

    protected function get8()
    {
        return $this->resolveFactory(static fn ()
        => new \Symfony\Component\Security\Core\Authentication\AuthenticationTrustResolver(), 'Symfony\\Component\\Security\\Core\\Authentication\\AuthenticationTrustResolverInterface');
    }

    protected function get9()
    {
        return $this->resolveFactory(static fn (\Psr\Container\ContainerInterface $container)
        => new \Symfony\Component\Security\Core\Authorization\AuthorizationChecker(
            $container->get(\Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface::class),
            new \Symfony\Component\Security\Core\Authorization\AccessDecisionManager([
                new \Symfony\Component\Security\Core\Authorization\Voter\AuthenticatedVoter(new \Symfony\Component\Security\Core\Authentication\AuthenticationTrustResolver()),
                new \Symfony\Component\Security\Core\Authorization\Voter\RoleVoter(),
                new \Symfony\Component\Security\Core\Authorization\Voter\RoleHierarchyVoter(new \Symfony\Component\Security\Core\Role\RoleHierarchy([
                    \Denosys\App\Database\Entities\User::ROLE_ADMIN => [\Denosys\App\Database\Entities\User::ROLE_USER],
                ]))
            ])
        ), 'Symfony\\Component\\Security\\Core\\Authorization\\AuthorizationCheckerInterface');
    }

    protected function get10()
    {
        return $this->resolveFactory(static fn (\Psr\Container\ContainerInterface $container)
        => new \Denosys\Core\Security\CurrentUser(
            $container->get(\Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface::class),
            $container->get(\Symfony\Component\Security\Core\User\UserProviderInterface::class)
        ), 'Denosys\\Core\\Security\\CurrentUser');
    }

    protected function get11()
    {
        return $this->resolveFactory(static fn (\Psr\Container\ContainerInterface $container) => new \Denosys\Core\Security\EntityUserProvider(
        $container->get(\Doctrine\ORM\EntityManagerInterface::class),
        \Denosys\App\Database\Entities\User::class,
        \Denosys\App\Database\Entities\User::USER_IDENTIFIER
    ), 'Symfony\\Component\\Security\\Core\\User\\UserProviderInterface');
    }

}
