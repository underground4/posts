<?php

namespace App\Exceptions;

use Symfony\Component\HttpFoundation\Response;

class NotFoundException extends AbstractHttpException
{
    public function __construct(string $message = null)
    {
        parent::__construct(Response::HTTP_NOT_FOUND, $message, null, [], Response::HTTP_NOT_FOUND);
    }
}
