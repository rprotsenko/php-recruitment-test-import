<?php

namespace Rprotsenko\DevTestImport\Controller;

use Snowdog\DevTest\Model\User;
use Snowdog\DevTest\Model\UserManager;
use Snowdog\DevTest\Model\Website;
use Snowdog\DevTest\Model\WebsiteManager;

class ImportAction
{
    /**
     * @var WebsiteManager
     */
    private $websiteManager;

    /**
     * @var User
     */
    private $user;

    public function __construct(
        WebsiteManager $websiteManager,
        UserManager $userManager
    ) {
        $this->websiteManager = $websiteManager;
        if (isset($_SESSION['login'])) {
            $this->user = $userManager->getByLogin($_SESSION['login']);
        }
    }

    public function execute()
    {
        require __DIR__ . '/../view/import.phtml';
    }

    protected function getWebsites()
    {
        if($this->user) {
            return  $this->websiteManager->getAllByUser($this->user);
        }
        return [];
    }
}