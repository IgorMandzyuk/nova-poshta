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
        $items = $observer->getEvent()->getOrder();
        $this->generator->generateParcel($items);
        return $observer;
    }
}
