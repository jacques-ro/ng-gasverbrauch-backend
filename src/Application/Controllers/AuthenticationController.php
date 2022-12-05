<?php

declare(strict_types=1);

namespace App\Application\Controllers;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use App\Domain\Authentication\AuthenticationService;
use App\Domain\Authentication\JwtTokenService;
use App\Domain\Authentication\UserCredentials;

class AuthenticationController
{

  private AuthenticationService $_authService;
  private JwtTokenService $_tokenService;

  public function __construct(AuthenticationService $authService, JwtTokenService $tokenService)
  {
    $this->_authService = $authService;
    $this->_tokenService = $tokenService;
  }

  public function authenticate(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
  {
    $user = $this->_userFromRequest($request);
    $auth = $this->_authService->tryAuthenticate($user);

    if ($auth) {
      $token = $this->_tokenService->createToken($user->user);
      $response->getBody()->write(json_encode(['bearer' => $token], JSON_FORCE_OBJECT));
    } else {
      $response->getBody()->write(json_encode($auth));
    }


    return $response;
  }

  private function _userFromRequest(ServerRequestInterface $request): UserCredentials
  {
    $userJson = $request->getParsedBody();
    return new UserCredentials($userJson->user, $userJson->password);
  }
}
