<?php

declare(strict_types=1);

namespace App\Domain\Authentication;

use DateInterval;
use DateTimeImmutable;
use PsrJwt\Factory\Jwt;
use \PsrJwt\Factory\JwtMiddleware;

class JwtTokenService
{
  private Jwt $_jwtFactory;
  private JwtTokenServiceConfiguration $_configuration;

  public function __construct(Jwt $jwtFactory, JwtTokenServiceConfiguration $configuration)
  {
    $this->_jwtFactory = $jwtFactory;
    $this->_configuration = $configuration;
  }

  public function createToken(string $userId)
  {
    $builder = $this->_jwtFactory->builder();

    $expiration = new DateTimeImmutable();
    $expiration = $expiration->add($this->_configuration->tokenLifetime);

    $token = $builder->setSecret($this->_configuration->tokenSecret)
      ->setPayloadClaim('uid', $userId)
      ->setExpiration($expiration->getTimestamp())
      ->build();

    return $token->getToken();
  }

  public function getAuthMiddleware()
  {
    return JwtMiddleware::json($this->_configuration->tokenSecret, '', ['message' => 'Authorisation Failed']);
  }
}
