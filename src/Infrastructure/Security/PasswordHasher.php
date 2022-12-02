<?php

declare(strict_types=1);

namespace App\Infrastructure\Security;

use App\Domain\Authentication\UserCredentials;

class PasswordHasher
{
  public function hash(string $password)
  {
    return password_hash($password, PASSWORD_BCRYPT, [
      'cost' => 15
    ]);
  }

  public function verify(string $password, string $hash)
  {
    return password_verify($password, $hash);
  }
}
