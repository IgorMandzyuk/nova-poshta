<?php

namespace Im\NovaPoshta\Model;

use Magento\Framework\Data\OptionSourceInterface;

class Cities implements OptionSourceInterface
{

    public function toOptionArray() : array
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $cities = $objectManager->create(\Im\NovaPoshta\Model\Config::class)->getConnection()->getCities();
        $cityList = [];
        foreach ($cities['data'] as $key => $city) {
            $cityList[] =  ['value' => $city['Description'] . ':' . $city['AreaDescription'], 'label' => $city['Description']];
        }
        return $cityList;
    }
}
