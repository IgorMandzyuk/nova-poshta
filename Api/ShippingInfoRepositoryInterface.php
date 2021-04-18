<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Im\NovaPoshta\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface ShippingInfoRepositoryInterface
{

    /**
     * Save ShippingInfo
     * @param \Im\NovaPoshta\Api\Data\ShippingInfoInterface $shippingInfo
     * @return \Im\NovaPoshta\Api\Data\ShippingInfoInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \Im\NovaPoshta\Api\Data\ShippingInfoInterface $shippingInfo
    );

    /**
     * Retrieve ShippingInfo
     * @param string $shippinginfoId
     * @return \Im\NovaPoshta\Api\Data\ShippingInfoInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function get($shippinginfoId);

    /**
     * Retrieve ShippingInfo matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Im\NovaPoshta\Api\Data\ShippingInfoSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete ShippingInfo
     * @param \Im\NovaPoshta\Api\Data\ShippingInfoInterface $shippingInfo
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \Im\NovaPoshta\Api\Data\ShippingInfoInterface $shippingInfo
    );

    /**
     * Delete ShippingInfo by ID
     * @param string $shippinginfoId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($shippinginfoId);
}

