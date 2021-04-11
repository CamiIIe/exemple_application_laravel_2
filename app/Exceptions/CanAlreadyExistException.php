<?php

namespace App\Exceptions;

use Exception;

class CanAlreadyExistException extends Exception
{
    public function __construct($email)
    {
        parent::__construct("Un utilisateur possède déjà l'email ".$email);
    }
}
