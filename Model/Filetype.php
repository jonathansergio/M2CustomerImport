<?php
/**
 * @author Jonathan Silva
 * @package Js_CustomerImport
 */
declare(strict_types=1);

namespace Js\CustomerImport\Model;

use Js\CustomerImport\Model\Manager\CsvManager;
use Js\CustomerImport\Model\Manager\JsonManager;
use Magento\Framework\Exception\LocalizedException;

class Filetype
{
    const FILE_TYPE_CSV = 'csv';
    const FILE_TYPE_JSON = 'json';

    /**
     * @var CsvManager
     */
    private CsvManager $csvManager;

    /**
     * @var JsonManager
     */
    private JsonManager $jsonManager;

    /**
     * @param CsvManager $csvManager
     * @param JsonManager $jsonManager
     */
    public function __construct(
        CsvManager $csvManager,
        JsonManager $jsonManager
    ) {
        $this->csvManager = $csvManager;
        $this->jsonManager = $jsonManager;
    }

    /**
     * @param $fileType
     * @param $fileName
     * @throws LocalizedException
     */
    public function setImporter($fileType, $fileName)
    {
        if ($fileType == self::FILE_TYPE_CSV) {
            $this->csvManager->readDataFromFile($fileName);
        } else if ($fileType == self::FILE_TYPE_JSON) {
            $this->jsonManager->readDataFromFile($fileName);
        }
    }
}
