<?php

namespace Im\NovaPoshta\Model\Config;

use Magento\Framework\Data\OptionSourceInterface;

class DeliveryType implements OptionSourceInterface
{
    public function toOptionArray() : array
    {
        return [
            ['value' => 'sklad', 'label' => __('Sklad - Sklad')],
            ['value' => 'office', 'label' => __('Post Office - Post Office')],
        ];
    }
}
