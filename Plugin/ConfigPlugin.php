<?php

namespace Im\NovaPoshta\Plugin;

class ConfigPlugin
{
    public $config;
    private  $messageManager;

    public function __construct(
       \Im\NovaPoshta\Model\Config $config,
        \Magento\Framework\Message\ManagerInterface $messageManager
    ) {
        $this->config = $config;
        $this->messageManager = $messageManager;
    }

    public function aroundSave(
        \Magento\Config\Model\Config $subject,
        \Closure $proceed
    ) {
       $api_key =  $subject->getData('groups')['novaposhta']['fields']['api_key']['value'];
        if (!empty($api_key)) {
            $result = $this->config->getConnection('dddvdv')->documentsTracking('59000000000000');
            var_dump($result); die();
            if ($result){
                $this->messageManager->addError('Not valid api key, please try another');

            }

        }
        return $proceed();
    }
}
