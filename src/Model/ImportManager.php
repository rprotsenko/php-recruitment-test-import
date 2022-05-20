<?php

namespace Rprotsenko\DevTestImport\Model;

use Snowdog\DevTest\Model\PageManager;
use Snowdog\DevTest\Model\WebsiteManager;

class ImportManager
{
    /**
     * @var PageManager
     */
    private $pageManager;

    /**
     * @var WebsiteManager
     */
    private $websiteManager;

    public function __construct(
        PageManager $pageManager,
        WebsiteManager $websiteManager
    ) {
        $this->pageManager = $pageManager;
        $this->websiteManager = $websiteManager;
    }

    public function import($websiteId, $filename)
    {
        $importedRows = 0;

        if (!$websiteId || !$filename) {
            return $importedRows;
        }

        try {

            $website = $this->websiteManager->getById($websiteId);
            if (!$website->getWebsiteId()) {
                throw new \Exception('Website not found');
            }

            $xml = $this->readSitemap($filename);
            foreach ($xml->url as $child) {
                $url = (string) $child->loc;
                $path = parse_url($url);
                if (isset($path['host'])
                    && isset($path['path'])
                    && strtolower(trim($path['host'])) == strtolower(trim($website->getHostname()))) {
                    $this->pageManager->create($website, ltrim($path['path'], '/'));
                    $importedRows++;
                }

            }
        } catch (\Exception $e) {
            throw $e;
        }

        return $importedRows;
    }

    private function readSitemap($filename)
    {
        $xml = simplexml_load_file($filename);
        if (!$xml) {
            throw new \Exception('Invalid sitemap file');
        }
        return $xml;
    }

}
