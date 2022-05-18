<?php

namespace Rprotsenko\DevTestImport\Command;

use Rprotsenko\DevTestImport\Model\ImportManager;
use Symfony\Component\Console\Output\OutputInterface;

class ImportCommand
{
    /**
     * @var SitemapImport
     */
    private $importManager;

    public function __construct(ImportManager $importManager)
    {
        $this->importManager = $importManager;
    }

    public function __invoke($website, $filename, OutputInterface $output)
    {
        try {
            $count = $this->importManager->import($website, $filename);
            $output->writeln('<info>Imported ' . $count . ' rows</info>');
        } catch (\Exception $e) {
            $output->writeln('<error>' . $e->getMessage() . '</error>');
        }
    }
}