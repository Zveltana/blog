<?php

namespace Application\Controllers;

use Application\Lib\Redirect;

class submitContact
{
    public function execute(): void {
        require('templates/submitContact.php');
    }
}
