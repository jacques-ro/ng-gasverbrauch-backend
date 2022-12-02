<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\UserCredentials;

use App\Domain\Authentication\IUserCredentialsRepository;
use App\Domain\Authentication\UserCredentials;
use App\Domain\Authentication\UserCredentialsNotFoundException;
use App\Infrastructure\Security\PasswordHasher;

class InMemoryUserCredentialsRepository implements IUserCredentialsRepository
{
  private PasswordHasher $_passwordHasher;

  /**
   * @var UserCredentials[]
   */
  private array $userCredentials;

  public function __construct(PasswordHasher $passwordHasher)
  {
    $this->_passwordHasher = $passwordHasher;

    $this->userCredentials = [
      'jacques' => new UserCredentials('jacques', $this->_passwordHasher->hash('password')),
    ];
  }


  /**
   * {@inheritdoc}
   */
  public function findUserCredentialsOfId(string $id): UserCredentials
  {
    if (!isset($this->userCredentials[$id])) {
      throw new UserCredentialsNotFoundException();
    }

    return $this->userCredentials[$id];
  }
}
