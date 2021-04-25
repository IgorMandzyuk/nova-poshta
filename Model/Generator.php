<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Im\NovaPoshta\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;

class Generator extends \Magento\Framework\Model\AbstractModel
{
    protected $_eventPrefix = 'im_novaposhta_shipping';

    private $scopeConfig;

    private $config;

    /**
     * Config constructor.
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param ResourceModel\ShippingInfo $resource
     * @param ResourceModel\ShippingInfo\Collection $resourceCollection
     * @param ScopeConfigInterface $scopeConfig
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        \Im\NovaPoshta\Model\ResourceModel\ShippingInfo $resource,
        \Im\NovaPoshta\Model\ResourceModel\ShippingInfo\Collection $resourceCollection,
        ScopeConfigInterface $scopeConfig,
        Config $config,
        array $data = []
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->config = $config;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    public function generateParcel()
    {
        $np = $this->config->getConnection();
        $senderInfo = $np->getCounterparties('Sender', 1, '', '');
        $sender = $senderInfo['data'][0];
        $city = $this->config->getSenderCity();
        $city = explode(":", $city);
        $senderRef = $np->getCity($city[0], $city[1])['data'][0]['Ref'];
        $senderWarehouses = $np->getWarehouses($senderRef);
        $result = $np->newInternetDocument(
            [
                'FirstName' => $sender['FirstName'],
                'MiddleName' => $sender['MiddleName'],
                'LastName' => $sender['LastName'],
                // Вместо FirstName, MiddleName, LastName можно ввести зарегистрированные ФИО отправителя или название фирмы для юрлиц
                // (можно получить, вызвав метод getCounterparties('Sender', 1, '', ''))
                // 'Description' => $sender['Description'],
                // Необязательное поле, в случае отсутствия будет использоваться из данных контакта
                // 'Phone' => '0631112233',
                // Город отправления
                // 'City' => 'Белгород-Днестровский',
                // Область отправления
               // 'Region' => 'Одесская',
                'CitySender' => $senderRef,
                'SenderAddress' => $senderWarehouses,
                // Отделение отправления по адресу
                // 'Warehouse' => $senderWarehouses['data'][0]['DescriptionRu'],
            ],
            // Данные получателя
            [
                'FirstName' => 'Сидор',
                'MiddleName' => 'Сидорович',
                'LastName' => 'Сиродов',
                'Phone' => '0509998877',
                'City' => 'Киев',
                'Region' => 'Киевская',
                'Warehouse' => 'Отделение №3: ул. Калачевская, 13 (Старая Дарница)',
            ],
            [
                // Дата отправления
                'DateTime' => date('d.m.Y'),
                // Тип доставки, дополнительно - getServiceTypes()
                'ServiceType' => 'WarehouseWarehouse',
                // Тип оплаты, дополнительно - getPaymentForms()
                'PaymentMethod' => 'Cash',
                // Кто оплачивает за доставку
                'PayerType' => 'Recipient',
                // Стоимость груза в грн
                'Cost' => '500',
                // Кол-во мест
                'SeatsAmount' => '1',
                // Описание груза
                'Description' => 'Кастрюля',
                // Тип доставки, дополнительно - getCargoTypes
                'CargoType' => 'Cargo',
                // Вес груза
                'Weight' => '10',
                // Объем груза в куб.м.
                'VolumeGeneral' => '0.5',
                // Обратная доставка
            ]
        );
        // var_dump($result); die();

        return $result;
    }
}
