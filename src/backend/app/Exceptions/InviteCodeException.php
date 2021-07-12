<?php

namespace App\Exceptions;

use Throwable;

class InviteCodeException extends \Exception
{
    public const MESSAGE = "Invite code has used";

    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message ?: self::MESSAGE, $code, $previous);
    }
}
