<?php

declare(strict_types=1);

namespace App\Domain\Authentication;

class AuthenticationService
{
  public function tryAuthenticate(UserCredentials $userCredentials)
  {
    return 'message from authentication service';
  }
}
