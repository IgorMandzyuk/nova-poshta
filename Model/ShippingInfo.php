<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Im\NovaPoshta\Model;

use Im\NovaPoshta\Api\Data\ShippingInfoInterface;
use Im\NovaPoshta\Api\Data\ShippingInfoInterfaceFactory;
use Magento\Framework\Api\DataObjectHelper;

class ShippingInfo extends \Magento\Framework\Model\AbstractModel
{

    protected $shippinginfoDataFactory;

    protected $dataObjectHelper;

    protected $_eventPrefix = 'im_novaposhta_shippinginfo';

    /**
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param ShippingInfoInterfaceFactory $shippinginfoDataFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param \Im\NovaPoshta\Model\ResourceModel\ShippingInfo $resource
     * @param \Im\NovaPoshta\Model\ResourceModel\ShippingInfo\Collection $resourceCollection
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        ShippingInfoInterfaceFactory $shippinginfoDataFactory,
        DataObjectHelper $dataObjectHelper,
        \Im\NovaPoshta\Model\ResourceModel\ShippingInfo $resource,
        \Im\NovaPoshta\Model\ResourceModel\ShippingInfo\Collection $resourceCollection,
        array $data = []
    ) {
        $this->shippinginfoDataFactory = $shippinginfoDataFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    /**
     * Retrieve shippinginfo model with shippinginfo data
     * @return ShippingInfoInterface
     */
    public function getDataModel()
    {
        $shippinginfoData = $this->getData();
        
        $shippinginfoDataObject = $this->shippinginfoDataFactory->create();
        $this->dataObjectHelper->populateWithArray(
            $shippinginfoDataObject,
            $shippinginfoData,
            ShippingInfoInterface::class
        );
        
        return $shippinginfoDataObject;
    }
}

