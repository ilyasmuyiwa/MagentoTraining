<?php
/**
 * Created by PhpStorm.
 * User: liyassoladogun
 * Date: 10/29/18
 * Time: 3:06 PM
 */

namespace Itcolony\CustomPayment\Gateway\Request\Builder;


use Magento\Payment\Gateway\Data\PaymentDataObjectInterface;
use Magento\Payment\Gateway\Request\BuilderInterface;
use Magento\Sales\Model\Order;

class Totals implements BuilderInterface
{
    public function build(array $buildSubject)
    {
        /** @var PaymentDataObjectInterface $paymentDataObject */
        $paymentDataObject  = $buildSubject['payment'];
        $payment = $paymentDataObject->getPayment();
        $order = $paymentDataObject->getOrder();
     /** @var Order $orderModel */
        $orderModel = $payment->getOrder();

        return [
            'tax' => [
                'amount' => $orderModel->getBaseTaxAmount()
            ],
            'duty' => [
                'amount' => '0'
            ],
            'shipping' => [
                'amount' => $orderModel->getShippingAmount(),
                'name' => $orderModel->getShippingMethod()
            ],
            'poNumber' => $order->getOrderIncrementId()
        ];
    }

}