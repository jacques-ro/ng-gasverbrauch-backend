<?php

declare(strict_types=1);

namespace App\Domain\Authentication;

use App\Infrastructure\Security\PasswordHasher;

class AuthenticationService
{
  private IUserCredentialsRepository $_userCredentialsRepository;
  private PasswordHasher $_passwordHasher;

  public function __construct(IUserCredentialsRepository $userCredentialsRepository, PasswordHasher $passwordHasher)
  {
    $this->_passwordHasher = $passwordHasher;
    $this->_userCredentialsRepository = $userCredentialsRepository;
  }

  public function tryAuthenticate(UserCredentials $userCredentials)
  {
    try {
      $stored = $this->_userCredentialsRepository->findUserCredentialsOfId($userCredentials->user);
      return $this->_passwordHasher->verify($userCredentials->password, $stored->password);
    } catch (\Throwable $th) {
      return false;
    }
  }
}
