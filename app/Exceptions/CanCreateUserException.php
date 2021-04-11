<?php

namespace App\Exceptions;

use Exception;

class CanCreateUserException extends Exception
{
    public function __construct($name)
    {
        parent::__construct("Impossible de créer l'utilisateur ".$name);
    }
}
