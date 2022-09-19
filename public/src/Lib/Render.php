<?php

namespace Application\Lib\Renderer;

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
