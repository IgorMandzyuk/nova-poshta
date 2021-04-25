<?php
namespace Im\NovaPoshta\Observer;

use Im\NovaPoshta\Model\Config;
use Im\NovaPoshta\Model\Generator;
use Magento\Framework\Event\ObserverInterface;
use Psr\Log\LoggerInterface;

class OrderPlaceAfter implements ObserverInterface
{
    protected  $logger;

    private  $config;
    private Generator $generator;

    /**
     * OrderPlaceAfter constructor.
     * @param Config $config
     * @param LoggerInterface $logger
     */
    public function __construct(
        Config $config,
        LoggerInterface $logger,
        Generator $generator
    )
    {
        $this->config = $config;
        $this->logger = $logger;
        $this->generator = $generator;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $this->generator->generateParcel();
       // $order = $observer->getEvent()->getOrder();
/*        foreach ($order->getAllItems() as $item) {
            $item->getQtyOrdered();
            var_dump($item);
            die();
        }*/
        return $observer;
    }
}
