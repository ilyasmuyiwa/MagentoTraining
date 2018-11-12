<?php
/**
 * Created by PhpStorm.
 * User: liyassoladogun
 * Date: 10/29/18
 * Time: 1:59 PM
 */

namespace Itcolony\CustomPayment\Gateway\Request\Builder;


use Magento\Payment\Gateway\Request\BuilderInterface;

class Charge implements BuilderInterface
{
   public function build(array $buildSubject)
   {
       $amount = $buildSubject['amount'];

       return [
           'transactionType' => 'authCaptureTransaction',
            'amount' => $amount
       ];
   }
}