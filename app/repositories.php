<?php

declare(strict_types=1);

use App\Domain\Authentication\IUserCredentialsRepository;
use App\Infrastructure\Persistence\UserCredentials\InMemoryUserCredentialsRepository;
use DI\ContainerBuilder;

return function (ContainerBuilder $containerBuilder) {
  // Here we map our UserRepository interface to its in memory implementation
  $containerBuilder->addDefinitions([
    IUserCredentialsRepository::class => DI\autowire(InMemoryUserCredentialsRepository::class)
  ]);
};
