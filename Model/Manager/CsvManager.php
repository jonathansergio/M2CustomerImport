<?php
/**
 * @author Jonathan Silva
 * @package Js_CustomerImport
 */
declare(strict_types=1);

namespace Js\CustomerImport\Model\Manager;

use Exception;
use Js\CustomerImport\Model\Customer\Importer;
use Magento\Framework\Exception\LocalizedException;

class CsvManager
{
    /**
     * @var Importer
     */
    private Importer $customerImporter;

    public function __construct(
        Importer $customerImporter
    ) {
        $this->customerImporter = $customerImporter;
    }

    /**
     * @param $fileName
     * @throws LocalizedException|Exception
     */
    public function readDataFromFile($fileName)
    {
        if (($handle = fopen($fileName, 'r')) === false) {
            die('Error opening file');
        }
        $headers = fgetcsv($handle, 256, ',');

        while ($row = fgetcsv($handle, 256, ',')) {
            $customerData = array_combine($headers, $row);
            $this->customerImporter->createCustomer($customerData);
        }
        fclose($handle);
    }
}
