<?php
namespace Itcolony\SeoOverwrite\Model;
use Magento\Framework\ObjectManagerInterface;


class Update extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{

    const CACHE_TAG = 'Itcolony_seooverwrite_update';

    protected $_cacheTag = 'Itcolony_seooverwrite_update';

    protected $_eventPrefix = 'Itcolony_seooverwrite_update';


    protected function _construct()
    {
        $this->_init('Itcolony\SeoOverwrite\Model\ResourceModel\Update');
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    public function getDefaultValues()
    {
        $values = [];

        return $values;
    }



}