<?php

declare(strict_types=1);

namespace App\Domain\Authentication;

use DateInterval;

class JwtTokenServiceConfiguration
{
  public readonly string $tokenSecret;
  public readonly DateInterval $tokenLifetime;

  public function __construct(string $tokenSecret, DateInterval $tokenLifetime)
  {
    $this->tokenSecret = $tokenSecret;
    $this->tokenLifetime = $tokenLifetime;
  }
}
