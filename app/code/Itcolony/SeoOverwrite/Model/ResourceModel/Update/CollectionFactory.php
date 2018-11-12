<?php
namespace Itcolony\SeoOverwrite\Model\ResourceModel\Update;

class CollectionFactory
{
    /**
     * Object Manager instance
     *
     * @var \Magento\Framework\ObjectManagerInterface
     */
    protected $_objectManager = null;

    /**
     * Instance name to create
     *
     * @var string
     */
    protected $_instanceName = null;

    /**
     * Factory constructor
     *
     * @param \Magento\Framework\ObjectManagerInterface $objectManager
     * @param \Itcolony\SeoOverwrite\Model\ResourceModel\Update\Collection $instanceName
     */
    public function __construct(\Magento\Framework\ObjectManagerInterface $objectManager,
                                $instanceName = 'Itcolony\SeoOverwrite\Model\ResourceModel\Update\Collection')
    {
        $this->_objectManager = $objectManager;
        $this->_instanceName = $instanceName;
    }

    /**
     * Create class instance with specified parameters
     *
     * @param array $data
     * @return \Itcolony\SeoOverwrite\Model\ResourceModel\Update\Collection
     */
    public function create(array $data = array())
    {
        return $this->_objectManager->create($this->_instanceName, $data);
    }
}