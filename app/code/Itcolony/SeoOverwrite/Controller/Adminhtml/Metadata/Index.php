<?php
namespace Itcolony\SeoOverwrite\Controller\Adminhtml\Metadata;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Backend\App\Action;

class Index extends Action
{
    const ADMIN_RESOURCE = 'Itcolony_SeoOverwrite::seodata';

    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    /**
     * Index action
     *
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Itcolony_SeoOverwrite::seodata');
        $resultPage->addBreadcrumb(__('Seo'), __('Seo'));
        $resultPage->addBreadcrumb(__('Manage Seo Data'), __('Manage Seo Data'));
        $resultPage->getConfig()->getTitle()->prepend(__('Seo Data'));

        return $resultPage;
    }
}
