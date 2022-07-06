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

class JsonManager
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
        $fileContent = file_get_contents($fileName);
        $customersData = json_decode($fileContent,true);
        foreach ($customersData as $customerData) {
            $this->customerImporter->createCustomer($customerData);
        }
    }
}
