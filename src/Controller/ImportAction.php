<?php

namespace Rprotsenko\DevTestImport\Controller;

use Snowdog\DevTest\Model\User;
use Snowdog\DevTest\Model\UserManager;

class ImportAction
{
    /**
     * @var User
     */
    private $user;

    public function __construct(
        UserManager $userManager
    ) {
        if (isset($_SESSION['login'])) {
            $this->user = $userManager->getByLogin($_SESSION['login']);
        }
    }

    public function execute()
    {
        require __DIR__ . '/../view/import.phtml';
    }
}