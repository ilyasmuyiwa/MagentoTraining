<?php

namespace Itcolony\SeoOverwrite\Block\Adminhtml\Metadata\Edit;


class Form extends \Magento\Backend\Block\Widget\Form\Generic
{

    /**
     * @var \Magento\Store\Model\System\Store
     */
    protected $_systemStore;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Data\FormFactory $formFactory
     * @param \Magento\Store\Model\System\Store $systemStore
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Registry $registry,
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Store\Model\System\Store $systemStore,
        array $data = []
    ) {
        $this->_systemStore = $systemStore;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * Init form
     *
     * @return void
     */

    /**
     * Prepare form
     *
     * @return $this
     */
    protected function _prepareForm()
    {
        /** @var \Itcolony\SeoOverwrite\Model\Update $model */
        $model = $this->_coreRegistry->registry('seooverwrite_metadata');

        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create(
            ['data' => ['id' => 'edit_form', 'action' => $this->getData('action'), 'method' => 'post']]
        );

        $form->setHtmlIdPrefix('metadata_');

        $fieldset = $form->addFieldset(
            'base_fieldset',
            ['legend' => __('General Information'), 'class' => 'fieldset-wide']
        );

        if ($model->getId()) {
            $fieldset->addField('entity_id', 'hidden', ['name' => 'entity_id']);
        }

        $fieldset->addField(
            'url',
            'text',
            ['name' => 'url', 'label' => __('URL'), 'title' => __('URL'), 'required' => true]
        );

        $fieldset->addField(
            'title',
            'textarea',
            ['name' => 'title', 'label' => __('Title'), 'title' => __('Title'), 'required' => false]
        );

        $fieldset->addField(
            'description',
            'textarea',
            ['name' => 'description', 'label' => __('MetaData Description'), 'title' => __('Description'), 'required' => false]
        );

        $fieldset->addField(
            'robots',
            'text',
            ['name' => 'robots', 'label' => __('Robots'), 'title' => __('Robots'), 'required' => false]
        );

        $fieldset->addField(
            'keywords',
            'text',
            ['name' => 'keywords', 'label' => __('Keywords'), 'title' => __('Keywords'), 'required' => false]
        );

        $form->setValues($model->getData());
        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }
}