<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Im\NovaPoshta\Api\Data;

interface ShippingInfoSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get ShippingInfo list.
     * @return \Im\NovaPoshta\Api\Data\ShippingInfoInterface[]
     */
    public function getItems();

    /**
     * Set content list.
     * @param \Im\NovaPoshta\Api\Data\ShippingInfoInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}

