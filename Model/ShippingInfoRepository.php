<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Im\NovaPoshta\Model;

use Im\NovaPoshta\Api\Data\ShippingInfoInterfaceFactory;
use Im\NovaPoshta\Api\Data\ShippingInfoSearchResultsInterfaceFactory;
use Im\NovaPoshta\Api\ShippingInfoRepositoryInterface;
use Im\NovaPoshta\Model\ResourceModel\ShippingInfo as ResourceShippingInfo;
use Im\NovaPoshta\Model\ResourceModel\ShippingInfo\CollectionFactory as ShippingInfoCollectionFactory;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Api\ExtensibleDataObjectConverter;
use Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Reflection\DataObjectProcessor;
use Magento\Store\Model\StoreManagerInterface;

class ShippingInfoRepository implements ShippingInfoRepositoryInterface
{

    protected $resource;

    protected $shippingInfoFactory;

    protected $shippingInfoCollectionFactory;

    protected $searchResultsFactory;

    protected $dataObjectHelper;

    protected $dataObjectProcessor;

    protected $dataShippingInfoFactory;

    protected $extensionAttributesJoinProcessor;

    private $storeManager;

    private $collectionProcessor;

    protected $extensibleDataObjectConverter;

    /**
     * @param ResourceShippingInfo $resource
     * @param ShippingInfoFactory $shippingInfoFactory
     * @param ShippingInfoInterfaceFactory $dataShippingInfoFactory
     * @param ShippingInfoCollectionFactory $shippingInfoCollectionFactory
     * @param ShippingInfoSearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param StoreManagerInterface $storeManager
     * @param CollectionProcessorInterface $collectionProcessor
     * @param JoinProcessorInterface $extensionAttributesJoinProcessor
     * @param ExtensibleDataObjectConverter $extensibleDataObjectConverter
     */
    public function __construct(
        ResourceShippingInfo $resource,
        ShippingInfoFactory $shippingInfoFactory,
        ShippingInfoInterfaceFactory $dataShippingInfoFactory,
        ShippingInfoCollectionFactory $shippingInfoCollectionFactory,
        ShippingInfoSearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager,
        CollectionProcessorInterface $collectionProcessor,
        JoinProcessorInterface $extensionAttributesJoinProcessor,
        ExtensibleDataObjectConverter $extensibleDataObjectConverter
    ) {
        $this->resource = $resource;
        $this->shippingInfoFactory = $shippingInfoFactory;
        $this->shippingInfoCollectionFactory = $shippingInfoCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataShippingInfoFactory = $dataShippingInfoFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->storeManager = $storeManager;
        $this->collectionProcessor = $collectionProcessor;
        $this->extensionAttributesJoinProcessor = $extensionAttributesJoinProcessor;
        $this->extensibleDataObjectConverter = $extensibleDataObjectConverter;
    }

    /**
     * {@inheritdoc}
     */
    public function save(
        \Im\NovaPoshta\Api\Data\ShippingInfoInterface $shippingInfo
    ) {
        /* if (empty($shippingInfo->getStoreId())) {
            $storeId = $this->storeManager->getStore()->getId();
            $shippingInfo->setStoreId($storeId);
        } */
        
        $shippingInfoData = $this->extensibleDataObjectConverter->toNestedArray(
            $shippingInfo,
            [],
            \Im\NovaPoshta\Api\Data\ShippingInfoInterface::class
        );
        
        $shippingInfoModel = $this->shippingInfoFactory->create()->setData($shippingInfoData);
        
        try {
            $this->resource->save($shippingInfoModel);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the shippingInfo: %1',
                $exception->getMessage()
            ));
        }
        return $shippingInfoModel->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function get($shippingInfoId)
    {
        $shippingInfo = $this->shippingInfoFactory->create();
        $this->resource->load($shippingInfo, $shippingInfoId);
        if (!$shippingInfo->getId()) {
            throw new NoSuchEntityException(__('ShippingInfo with id "%1" does not exist.', $shippingInfoId));
        }
        return $shippingInfo->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->shippingInfoCollectionFactory->create();
        
        $this->extensionAttributesJoinProcessor->process(
            $collection,
            \Im\NovaPoshta\Api\Data\ShippingInfoInterface::class
        );
        
        $this->collectionProcessor->process($criteria, $collection);
        
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        
        $items = [];
        foreach ($collection as $model) {
            $items[] = $model->getDataModel();
        }
        
        $searchResults->setItems($items);
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * {@inheritdoc}
     */
    public function delete(
        \Im\NovaPoshta\Api\Data\ShippingInfoInterface $shippingInfo
    ) {
        try {
            $shippingInfoModel = $this->shippingInfoFactory->create();
            $this->resource->load($shippingInfoModel, $shippingInfo->getShippinginfoId());
            $this->resource->delete($shippingInfoModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the ShippingInfo: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteById($shippingInfoId)
    {
        return $this->delete($this->get($shippingInfoId));
    }
}

