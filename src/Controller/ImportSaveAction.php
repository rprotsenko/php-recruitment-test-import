<?php

namespace Rprotsenko\DevTestImport\Controller;

use Rprotsenko\DevTestImport\Model\ImportManager;

class ImportSaveAction
{
    /**
     * @var ImportManager
     */
    private $importManager;

    public function __construct(ImportManager $importManager)
    {
        $this->importManager = $importManager;
    }

    public function execute()
    {
        $website = $_POST['website'] ?? null;
        $filename = isset($_FILES['fileToUpload'], $_FILES['fileToUpload']['tmp_name'])
            ? $_FILES['fileToUpload']['tmp_name']
            : null;
        if ($website && $filename) {
            try {
                $count = $this->importManager->import($website, $filename);
                $_SESSION['flash'] = 'Imported ' . $count . ' rows';
            } catch (\Exception $e) {
                $_SESSION['flash'] = $e->getMessage();
            }
        } else {
            $_SESSION['flash'] = 'Website or file cannot be empty!';
        }
        header('Location: /import');
    }
}