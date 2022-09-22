<?php

namespace Application\Lib;

class Render
{
    function execute (string $view, array $data = [])
    {
        ob_start();
        extract($data);
        include __DIR__ . '/../views/' . $view;
        $content = ob_get_clean();
        include __DIR__ . '/../views/template.php';
    }
}
