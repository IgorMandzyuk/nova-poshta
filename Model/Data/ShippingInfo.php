<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Im\NovaPoshta\Model\Data;

use Im\NovaPoshta\Api\Data\ShippingInfoInterface;

class ShippingInfo extends \Magento\Framework\Api\AbstractExtensibleObject implements ShippingInfoInterface
{

    /**
     * Get shippinginfo_id
     * @return string|null
     */
    public function getShippinginfoId()
    {
        return $this->_get(self::SHIPPINGINFO_ID);
    }

    /**
     * Set shippinginfo_id
     * @param string $shippinginfoId
     * @return \Im\NovaPoshta\Api\Data\ShippingInfoInterface
     */
    public function setShippinginfoId($shippinginfoId)
    {
        return $this->setData(self::SHIPPINGINFO_ID, $shippinginfoId);
    }

    /**
     * Get content
     * @return string|null
     */
    public function getContent()
    {
        return $this->_get(self::CONTENT);
    }

    /**
     * Set content
     * @param string $content
     * @return \Im\NovaPoshta\Api\Data\ShippingInfoInterface
     */
    public function setContent($content)
    {
        return $this->setData(self::CONTENT, $content);
    }

    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return \Im\NovaPoshta\Api\Data\ShippingInfoExtensionInterface|null
     */
    public function getExtensionAttributes()
    {
        return $this->_getExtensionAttributes();
    }

    /**
     * Set an extension attributes object.
     * @param \Im\NovaPoshta\Api\Data\ShippingInfoExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \Im\NovaPoshta\Api\Data\ShippingInfoExtensionInterface $extensionAttributes
    ) {
        return $this->_setExtensionAttributes($extensionAttributes);
    }
}

