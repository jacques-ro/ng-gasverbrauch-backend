<?php

declare(strict_types=1);

namespace App\Application\Controllers;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;


class HomeController
{
  public function home(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
  {
    $response->getBody()->write(json_encode(['message' => 'Your request was accepted'], JSON_FORCE_OBJECT));
    return $response;
  }
}
