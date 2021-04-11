<?php

namespace App\Exceptions;

use Exception;

class CanDeleteUserException extends Exception
{
    public function __construct($id)
    {
        parent::__construct("Impossible de supprimer l'utilisateur ayant pour identifiant ".$id);
    }
}
