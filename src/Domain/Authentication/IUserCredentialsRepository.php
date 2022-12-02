<?php

declare(strict_types=1);

namespace App\Domain\Authentication;

interface IUserCredentialsRepository
{
  /**
   * @param int $id
   * @return UserCredentials
   * @throws UserCredentialsNotFoundException
   */
  public function findUserCredentialsOfId(string $id): UserCredentials;
}
