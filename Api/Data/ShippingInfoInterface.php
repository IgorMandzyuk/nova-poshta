<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Im\NovaPoshta\Api\Data;

interface ShippingInfoInterface extends \Magento\Framework\Api\ExtensibleDataInterface
{

    const SHIPPINGINFO_ID = 'shippinginfo_id';
    const CONTENT = 'content';

    /**
     * Get shippinginfo_id
     * @return string|null
     */
    public function getShippinginfoId();

    /**
     * Set shippinginfo_id
     * @param string $shippinginfoId
     * @return \Im\NovaPoshta\Api\Data\ShippingInfoInterface
     */
    public function setShippinginfoId($shippinginfoId);

    /**
     * Get content
     * @return string|null
     */
    public function getContent();

    /**
     * Set content
     * @param string $content
     * @return \Im\NovaPoshta\Api\Data\ShippingInfoInterface
     */
    public function setContent($content);

    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return \Im\NovaPoshta\Api\Data\ShippingInfoExtensionInterface|null
     */
    public function getExtensionAttributes();

    /**
     * Set an extension attributes object.
     * @param \Im\NovaPoshta\Api\Data\ShippingInfoExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \Im\NovaPoshta\Api\Data\ShippingInfoExtensionInterface $extensionAttributes
    );
}

