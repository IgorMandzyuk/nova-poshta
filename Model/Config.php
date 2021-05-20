<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Im\NovaPoshta\Model;

use LisDev\Delivery\NovaPoshtaApi2;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

class Config extends \Magento\Framework\Model\AbstractModel
{
    /**
     *
     */
    const XML_PATH_EXTENSION_ENABLED = 'carriers/novaposhta/active';

    /**
     *
     */
    const XML_PATH_EXTENSION_API_KEY = 'carriers/novaposhta/api_key';

    /**
     *
     */
    const XML_PATH_EXTENSION_CARRIER_TITLE = 'carriers/novaposhta/title';

    /**
     *
     */
    const XML_PATH_EXTENSION_SENDER_CITY = 'carriers/novaposhta/sender_city';

    /**
     *
     */
    const XML_PATH_EXTENSION_PLUGIN_LOCALE = 'carriers/novaposhta/content_language';

    /**
     *
     */
    const XML_PATH_EXTENSION_DELIVERY_TYPE = 'carriers/novaposhta/delivery_type';

    protected $_eventPrefix = 'im_novaposhta_shipping';

    private ScopeConfigInterface $scopeConfig;

    /**
     * Config constructor.
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param ResourceModel\ShippingInfo $resource
     * @param ResourceModel\ShippingInfo\Collection $resourceCollection
     * @param ScopeConfigInterface $scopeConfig
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        \Im\NovaPoshta\Model\ResourceModel\ShippingInfo $resource,
        \Im\NovaPoshta\Model\ResourceModel\ShippingInfo\Collection $resourceCollection,
        ScopeConfigInterface $scopeConfig,
        array $data = []
    ) {
        $this->scopeConfig = $scopeConfig;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    /**
     * @param null $storeId
     * @return bool
     */
    protected function isEnabled($storeId = null)
    {
        return (bool)$this->scopeConfig->getValue(
            self::XML_PATH_EXTENSION_ENABLED,
            $storeId
        );
    }

    /**
     * @return NovaPoshtaApi2|string
     */
    public function getConnection()
    {
        $api_key = $this->getApiKeyValue();
        if ($api_key) {
            $np = new NovaPoshtaApi2(
                $api_key,
                $this->getLocale(), // Язык возвращаемых данных: ru (default) | ua | en
                false, // При ошибке в запросе выбрасывать Exception: FALSE (default) | TRUE
                'curl' // Используемый механизм запроса: curl (defalut) | file_get_content
            );
        }
        return $np;
    }

    /**
     * @param null $storeId
     * @return string
     */
    protected function getApiKeyValue($storeId = null)
    {
        return (string)$this->scopeConfig->getValue(
            self::XML_PATH_EXTENSION_API_KEY,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * @param null $storeId
     * @return mixed
     */
    protected function getCarrierTitle($storeId = null)
    {
        return (string)$this->scopeConfig->getValue(
            self::XML_PATH_EXTENSION_CARRIER_TITLE,
            ScopeInterface::SCOPE_STORE
        );
    }

    protected function getCities()
    {
        return $this->getConnection()->getCities();
    }

    public function getSenderCity($storeId = null)
    {
        return (string)$this->scopeConfig->getValue(
            self::XML_PATH_EXTENSION_SENDER_CITY,
            ScopeInterface::SCOPE_STORE
        );
    }

    public function getLocale()
    {
        return (string)$this->scopeConfig->getValue(
            self::XML_PATH_EXTENSION_PLUGIN_LOCALE,
            ScopeInterface::SCOPE_STORE
        );
    }

    public function getDeliveryType()
    {
        return (string)$this->scopeConfig->getValue(
            self::XML_PATH_EXTENSION_DELIVERY_TYPE,
            ScopeInterface::SCOPE_STORE
        );
    }

}
