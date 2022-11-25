<?php

declare(strict_types=1);

namespace App\Domain\Authentication;

class UserCredentials
{
  public $user;
  public $password;

  public function __construct($user, $password)
  {
    $this->user = $user;
    $this->password = $password;
  }
}
