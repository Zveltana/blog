<?php

namespace Application\Lib\Redirection;

class Redirect
{
    function execute(string $url)
    {
        header('location: ' . $url);
        exit;
    }
}