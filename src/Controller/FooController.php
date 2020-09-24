<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;

class FooController
{
    public function __invoke()
    {
        return new Response('It works!');
    }
}
