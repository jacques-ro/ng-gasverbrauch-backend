<?php

declare(strict_types=1);

use App\Application\Actions\User\ListUsersAction;
use App\Application\Actions\User\ViewUserAction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;
use App\Application\Controllers\AuthenticationController;
use App\Application\Controllers\HomeController;
use Psr\Container\ContainerInterface;
use App\Domain\Authentication\JwtTokenService;

return function (App $app, ContainerInterface $c) {

  $tokenService = $c->get(JwtTokenService::class);

  $app->options('/{routes:.*}', function (Request $request, Response $response) {
    // CORS Pre-Flight OPTIONS Request Handler
    return $response;
  });

  /**
   * Expects user credentials to authenticate the user and create
   * a JWT for them
   */
  $app->post('/authenticate', [AuthenticationController::class, 'authenticate']);

  $app->get('/home', [HomeController::class, 'home'])->add($tokenService->getAuthMiddleware());

  $app->post('/', function (Request $request, Response $response) {

    $body = $request->getParsedBody();
    $response->getBody()->write(json_encode($body));
    return $response;
  });

  $app->group('/users', function (Group $group) {
    $group->get('', ListUsersAction::class);
    $group->get('/{id}', ViewUserAction::class);
  });
};
