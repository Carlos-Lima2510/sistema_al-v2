<?php

namespace App\Exceptions;

use Exception;

class MarcaMaterialException extends Exception
{
    protected $message = 'Marca Material not found';
}
