<?php

declare(strict_types=1);

namespace App\Application\Controllers;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use App\Domain\Authentication\AuthenticationService;
use App\Domain\Authentication\UserCredentials;

class AuthenticationController
{

  private $_authService;

  public function __construct(AuthenticationService $authService)
  {
    $this->_authService = $authService;
  }

  public function authenticate(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
  {
    $response->getBody()->write(json_encode($this->_authService->tryAuthenticate($this->_userFromRequest($request))));
    return $response;
  }

  private function _userFromRequest(ServerRequestInterface $request)
  {
    return new UserCredentials('user', 'password');
  }
}
