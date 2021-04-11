<?php

namespace App\Exceptions;

use Exception;

class CanUpdateUserException extends Exception
{
    public function __construct($id)
    {
        parent::__construct("Impossible de mettre à jour l'utilisateur ayant pour identifiant ".$id);
    }
}
