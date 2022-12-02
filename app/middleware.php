<?php

declare(strict_types=1);

use App\Application\Middleware\AuthMiddleware;
use App\Application\Middleware\JsonBodyParserMiddleware;
use Slim\App;

return function (App $app) {
  $app->add(JsonBodyParserMiddleware::class);
  $app->add(AuthMiddleware::class);
};
