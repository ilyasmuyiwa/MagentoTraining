<?php
/**
 * Copyright © 2016 MageWorx. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace Itcolony\SeoOverwrite\Model\Observer;

/**
 * Observer class for product template apply proccess
 */

class SeoModifier implements \Magento\Framework\Event\ObserverInterface
{
    protected $urlInterface;
    protected $seoData;
    protected $pageConfig;

    public function __construct(
        \Magento\Framework\UrlInterface $urlInterface,
        \Itcolony\SeoOverwrite\Model\Update $seoData,
        \Magento\Framework\View\Page\Config $pageConfig

    ) {
       $this->urlInterface = $urlInterface;
       $this->seoData = $seoData;
       $this->pageConfig = $pageConfig;

    }

    /**
     * Modify category data and meta head
     * Event: layout_generate_blocks_after
     *
     * @param \Magento\Framework\Event\Observer $observer
     * @return void
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $currentUrl = $this->urlInterface->getCurrentUrl();

        $seoDataCollection = $this->seoData->getCollection()
            ->addFieldToSelect('url')
            ->addFieldToSelect('title')
            ->addFieldToSelect('description')
            ->addFieldToSelect('robots')
            ->addFieldToSelect('keywords')
            ->addFieldToFilter('url', $currentUrl)
            ->setPageSize(1);
        if ($seoDataCollection->getSize() > 0) {

            $seoData = $seoDataCollection->getFirstItem();
            if (trim($seoData->getTitle()) !== '') {
                $this->pageConfig->getTitle()->set($seoData->getTitle());
            }
            if (trim($seoData->getDescription()) !== '') {
                $this->pageConfig->setDescription($seoData->getDescription());
            }
            if (trim($seoData->getRobots()) !== '') {
                $this->pageConfig->setRobots($seoData->getRobots());
            }
            if (trim($seoData->getKeywords()) !== '') {
                $this->pageConfig->setKeywords($seoData->getKeywords());
            }

        }
    }
}
