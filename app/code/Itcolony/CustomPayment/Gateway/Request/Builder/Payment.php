<?php
/**
 * Created by PhpStorm.
 * User: liyassoladogun
 * Date: 10/29/18
 * Time: 2:08 PM
 */

namespace Itcolony\CustomPayment\Gateway\Request\Builder;


use Itcolony\CustomPayment\Observer\DataAssignObserver;
use Magento\Payment\Gateway\Data\PaymentDataObjectInterface;
use Magento\Payment\Gateway\Request\BuilderInterface;
use Magento\Payment\Model\InfoInterface;
use Magento\Sales\Model\Order\Payment as OrderPayment;

class Payment implements BuilderInterface
{
    public function build(array $buildSubject)
    {
        /** @var PaymentDataObjectInterface $paymentDataObject */
        $paymentDataObject = $buildSubject['payment'];
        /** @var InfoInterface $payment */
        /** @var OrderPayment $payment */
        $payment = $paymentDataObject->getPayment();

        return [
              'payment' => [
                  'creditCard' => [
                      'cardNumber' => $payment->getData(DataAssignObserver::CC_NUMBER),
                      'expirationDate' => $this->getCardExpirationDate($payment),
                      'cardCode' => $payment->getData(DataAssignObserver::CC_CID)
                  ]
              ]
        ];
    }

    /**
     * @param InfoInterface $payment
     * @return string
     */
    private function getCardExpirationDate(InfoInterface $payment) {

        return sprintf(
            '%s-%s',
            $payment->getData(DataAssignObserver::CC_EXP_YEAR),
            $payment->getData(DataAssignObserver::CC_EXP_MONTH)
        );
    }

}