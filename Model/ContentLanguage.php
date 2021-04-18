<?php

namespace Im\NovaPoshta\Model;

use Magento\Framework\Data\OptionSourceInterface;


class ContentLanguage implements OptionSourceInterface
{
    /**
     * @return array
     */
    public function toOptionArray() : array
    {
        return [
            ['value' => 'ua', 'label' => __('Ukrainian')],
            ['value' => 'ru', 'label' => __('Russian')],
            ['value' => 'en', 'label' => __('English')],
        ];
    }
}
