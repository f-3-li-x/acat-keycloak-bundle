<?php

namespace ACAT\KeycloakBundle\Security;

use Symfony\Component\Security\Core\User\InMemoryUser;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\Security\Core\User\AttributesBasedUserProviderInterface;

/**
 *
 */
class KeycloakProvider implements AttributesBasedUserProviderInterface
{

    /**
     * @param string $userIdentifierClaim
     */
    public function __construct(
        #[Autowire('%acat_keycloak.identifier_claim%')]
        private readonly string $userIdentifierClaim
    )
    {
    }

    /**
     * @param string $identifier
     * @param array $attributes
     * @return UserInterface
     */
    public function loadUserByIdentifier(string $identifier, array $attributes = []): UserInterface
    {
        $userIdentifier = $attributes[$this->userIdentifierClaim] ?? $identifier;
        return new InMemoryUser((string)$userIdentifier, null);
    }


    /**
     * @param UserInterface $user
     * @return UserInterface
     */
    public function refreshUser(UserInterface $user): UserInterface
    {
        if (!$this->supportsClass($user::class)) {
            throw new UnsupportedUserException(sprintf('Unsupported user class "%s".', $user::class));
        }

        return $user;
    }

    /**
     * @param string $class
     * @return bool
     */
    public function supportsClass(string $class): bool
    {
        return is_a($class, InMemoryUser::class, true);
    }
}
