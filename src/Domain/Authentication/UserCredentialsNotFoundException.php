<?php

declare(strict_types=1);

namespace App\Domain\Authentication;

use App\Domain\DomainException\DomainRecordNotFoundException;

class UserCredentialsNotFoundException extends DomainRecordNotFoundException
{
  public $message = 'No user credentials are stored for the given user.';
}
