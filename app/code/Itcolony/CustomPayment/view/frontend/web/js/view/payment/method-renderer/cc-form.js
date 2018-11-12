define([
    'Magento_Payment/js/view/payment/cc-form'
],  function (Component) {
    'use strict';
    return Component.extend({
        defaults: {
            template: 'Itcolony_CustomPayment/payment/cc-form',
            code: 'itcolony_custompayment'
        },
        getCode: function () {
            return this.code
        },
        isActive: function () {
            return this.getCode() === this.isChecked();
        }
    });
    });