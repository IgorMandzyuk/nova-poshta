<?php

namespace Im\NovaPoshta\Model;

use Magento\Framework\Data\OptionSourceInterface;

class Price implements OptionSourceInterface
{
    public function toOptionArray() : array
    {
        return [
            ['value' => 'default', 'label' => __('Default Price')],
            ['value' => 'all', 'label' => __('One Price For All')],
            ['value' => 'custom', 'label' => __('Custom by width and height')],
        ];
    }
}
