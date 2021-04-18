<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Im\NovaPoshta\Model;

use LisDev\Delivery\NovaPoshtaApi2;
use Magento\Framework\App\Config\ScopeConfigInterface;

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
     * @param $api_key
     * @return false|NovaPoshtaApi2
     */
    public function getConnection($api_key)
    {
        $np = false;
        if (!empty($api_key)) {
            $np = new NovaPoshtaApi2(
                $api_key,
                'ru', // Язык возвращаемых данных: ru (default) | ua | en
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
            $storeId
        );
    }

    /**
     * @param null $storeId
     * @return mixed
     */
    protected function getCarrierTitle($storeId = null)
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_EXTENSION_CARRIER_TITLE,
            $storeId
        );
    }
}
