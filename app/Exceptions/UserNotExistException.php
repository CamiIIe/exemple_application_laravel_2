<?php

namespace App\Exceptions;

use Exception;

class UserNotExistException extends Exception
{
    public function __construct($id)
    {
        parent::__construct("Aucun utilisateur ne possède l'identifiant ".$id);
    }
}
