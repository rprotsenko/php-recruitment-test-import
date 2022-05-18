<?php

namespace Rprotsenko\DevTestImport\Menu;

use Snowdog\DevTest\Menu\AbstractMenu;

class ImportMenu extends AbstractMenu
{
    public function isActive()
    {
        return $_SERVER['REQUEST_URI'] == '/import';
    }

    public function getHref()
    {
        return '/import';
    }

    public function getLabel()
    {
        return 'Import';
    }

    public function __invoke()
    {
        if(isset($_SESSION['login'])) {
            return parent::__invoke();
        }
    }
}