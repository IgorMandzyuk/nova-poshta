<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Im\NovaPoshta\Model\Carrier;

use Im\NovaPoshta\Model\Config;
use Magento\Quote\Model\Quote\Address\RateRequest;

class NovaPoshta extends \Magento\Shipping\Model\Carrier\AbstractCarrier implements
    \Magento\Shipping\Model\Carrier\CarrierInterface
{

    protected $_code = 'novaposhta';

    protected $_code2 = 'novaposhtaa';


    protected $_isFixed = true;

    protected $_rateResultFactory;

    protected $_rateMethodFactory;

    private  $config;

    /**
     * Constructor
     *
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     * @param \Magento\Quote\Model\Quote\Address\RateResult\ErrorFactory $rateErrorFactory
     * @param \Psr\Log\LoggerInterface $logger
     * @param \Magento\Shipping\Model\Rate\ResultFactory $rateResultFactory
     * @param \Magento\Quote\Model\Quote\Address\RateResult\MethodFactory $rateMethodFactory
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Quote\Model\Quote\Address\RateResult\ErrorFactory $rateErrorFactory,
        \Psr\Log\LoggerInterface $logger,
        \Magento\Shipping\Model\Rate\ResultFactory $rateResultFactory,
        \Magento\Quote\Model\Quote\Address\RateResult\MethodFactory $rateMethodFactory,
        \im\NovaPoshta\Model\Config $config,
        array $data = []
    ) {
        $this->_rateResultFactory = $rateResultFactory;
        $this->_rateMethodFactory = $rateMethodFactory;
        $this->config = $config;
        parent::__construct($scopeConfig, $rateErrorFactory, $logger, $data);
    }

    /**
     * {@inheritdoc}
     */
    public function collectRates(RateRequest $request)
    {
        $shippingPrice = $this->getConfigData('price');
        $result = $this->_rateResultFactory->create();
        $deliveryType = $this->config->getDeliveryType();
        $methodOffice = $this->_rateMethodFactory->create();
        $methodSkald = $this->_rateMethodFactory->create();

        if ('office' == $deliveryType) {

            $methodOffice->setCarrier($this->_code);
            $methodOffice->setCarrierTitle($this->getConfigData('title'));
            $methodOffice->setMethod($this->_code2);
            $methodOffice->setMethodTitle('ssss');
            $result->append($methodOffice);

        }elseif ('sklad' == $deliveryType) {

            $methodSkald->setMethod($this->_code);
            $methodSkald->setMethodTitle($this->getConfigData('name'));
            $methodSkald->setMethod($this->_code2);
            $methodSkald->setMethodTitle('ssss');
            $result->append($methodSkald);
        }

/*        if (!$this->getConfigFlag('active')) {
            return false;
        }*/

         //   $method->setPrice('100000');
         //   $method->setCost('10000000');

        return $result;
    }

    /**
     * getAllowedMethods
     *
     * @return array
     */
    public function getAllowedMethods()
    {
        return [$this->_code => $this->getConfigData('name'), $this->_code2 => $this->getConfigData('name')];
    }
}
