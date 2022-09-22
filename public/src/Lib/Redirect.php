<?php

namespace Application\Lib;

class Redirect
{
    function execute(string $url)
    {
        header('location: ' . $url);
        exit;
    }
}