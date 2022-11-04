<?php

namespace Application\Common;

class Redirect
{
    function execute(string $url)
    {
        header('location: ' . $url);
    }
}