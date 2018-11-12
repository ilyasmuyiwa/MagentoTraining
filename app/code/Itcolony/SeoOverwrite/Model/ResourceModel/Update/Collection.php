<?php
namespace Itcolony\SeoOverwrite\Model\ResourceModel\Update;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'entity_id';
    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Itcolony\SeoOverwrite\Model\Update', 'Itcolony\SeoOverwrite\Model\ResourceModel\Update');
    }

}
