<?php
use Snowdog\DevTest\Component\CommandRepository;
use Snowdog\DevTest\Component\Menu;
use Snowdog\DevTest\Component\RouteRepository;

use Rprotsenko\DevTestImport\Command\ImportCommand;
use Rprotsenko\DevTestImport\Controller\ImportAction;
use Rprotsenko\DevTestImport\Controller\ImportSaveAction;
use Rprotsenko\DevTestImport\Menu\ImportMenu;


CommandRepository::registerCommand('sitemap-import [website] [filename]', ImportCommand::class);

Menu::register(ImportMenu::class, 30);

RouteRepository::registerRoute('GET', '/import', ImportAction::class, 'execute');
RouteRepository::registerRoute('POST', '/import', ImportSaveAction::class, 'execute');

