define([
    'uiComponent',
    'Magento_Checkout/js/model/payment/renderer-list'
],
    function (Component, rendererList) {
       'use strict';
       rendererList.push({
           type: 'itcolony_custompayment',
           component: 'Itcolony_CustomPayment/js/view/payment/method-renderer/cc-form'
       })
        return Component.extend({});
        
    });