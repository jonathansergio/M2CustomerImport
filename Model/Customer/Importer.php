<?php
/**
 * @author Jonathan Silva
 * @package Js_CustomerImport
 */
declare(strict_types=1);

namespace Js\CustomerImport\Model\Customer;

use Exception;
use Magento\Customer\Model\CustomerFactory;
use Magento\Store\Model\StoreManagerInterface;

class Importer
{
    const CUSTOMER_FIRSTNAME = 'fname';
    const CUSTOMER_LASTNAME = 'lname';
    const CUSTOMER_EMAIL = 'emailaddress';

    /**
     * @var StoreManagerInterface
     */
    private $storeManager;

    /**
     * @var CustomerFactory
     */
    private $customerFactory;

    /**
     * @param CustomerFactory $customerFactory
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(
        CustomerFactory $customerFactory,
        StoreManagerInterface $storeManager
    ) {
        $this->customerFactory = $customerFactory;
        $this->storeManager = $storeManager;
    }

    /**
     * @param $customerData
     * @throws Exception
     */
    public function createCustomer($customerData)
    {
        try {
            $store = $this->storeManager->getStore();
            $websiteId = $this->storeManager->getStore()->getWebsiteId();
            $customer = $this->customerFactory->create();

            $customer->setWebsiteId($websiteId)
                ->setStore($store)
                ->setFirstname($customerData[self::CUSTOMER_FIRSTNAME])
                ->setLastname($customerData[self::CUSTOMER_LASTNAME])
                ->setEmail($customerData[self::CUSTOMER_EMAIL]);

            $customer->save();
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
}
