<?php

namespace Im\NovaPoshta\Controller\Adminhtml\Index;

use Im\NovaPoshta\Model\Generator;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

/**
 * Class Index
 * @package Im\NovaPoshta\Controller\Adminhtml\Index\Index
 */
class Index extends  \Magento\Backend\App\Action
{


    /**
     * Index resultPageFactory
     * @var PageFactory
     */
    protected $resultPageFactory;

    private  $generator;

    /**
     * Index constructor.
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        Generator $generator
    )
    {
        $this->resultPageFactory = $resultPageFactory;
        $this->generator = $generator;
        return parent::__construct($context);
    }

    /**
     * Function execute
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $this->generator->generateParcel();
        return $this->resultPageFactory->create();
    }
}
