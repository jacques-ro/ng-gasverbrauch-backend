<?php

declare(strict_types=1);

use App\Application\Controllers\HomeController;
use App\Application\Settings\SettingsInterface;
use App\Domain\Authentication\JwtTokenService;
use App\Domain\Authentication\JwtTokenServiceConfiguration;
use App\Infrastructure\Security\PasswordHasher;
use DI\ContainerBuilder;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\Processor\UidProcessor;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;
use PsrJwt\Factory\Jwt;

return function (ContainerBuilder $containerBuilder) {
  $containerBuilder->addDefinitions([
    LoggerInterface::class => function (ContainerInterface $c) {
      $settings = $c->get(SettingsInterface::class);

      $loggerSettings = $settings->get('logger');
      $logger = new Logger($loggerSettings['name']);

      $processor = new UidProcessor();
      $logger->pushProcessor($processor);

      $handler = new StreamHandler($loggerSettings['path'], $loggerSettings['level']);
      $logger->pushHandler($handler);

      return $logger;
    },

    PasswordHasher::class => DI\autowire(),
    AuthenticationService::class => DI\autowire(),

    Jwt::class => DI\autowire(),
    // Das Format für die Erstellung von DateInterval ist hier beschrieben: https://www.php.net/manual/de/dateinterval.construct.php
    // TODO: Das Tokensecret unterhalb ist nur für Dev. Andere Umgebungen müssen das Token aus einem Ort laden, der nicht im Repository landet.
    JwtTokenService::class => DI\autowire()->constructorParameter('configuration', new JwtTokenServiceConfiguration('Some$tr0ng#S3cre7ForDeV*', new DateInterval('PT10M'))), /// 10 Minuten Gültigkeit

    HomeController::class => DI\autowire(),
    AuthenticationController::class => DI\autowire(),
  ]);
};
