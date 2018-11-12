<?php
/**
 * Created by PhpStorm.
 * User: liyassoladogun
 * Date: 10/29/18
 * Time: 2:51 PM
 */

namespace Itcolony\CustomPayment\Gateway\Request\Builder;


use Magento\Payment\Gateway\Data\PaymentDataObjectInterface;
use Magento\Payment\Gateway\Request\BuilderInterface;
use Magento\Sales\Api\Data\OrderItemInterface;
use MEQP2\Tests\NamingConventions\true\string;

class ProductItems implements BuilderInterface
{
    /**
     * @param array $buildSubject
     * @return array
     */
    public function build(array $buildSubject)
    {
       /** @var PaymentDataObjectInterface $paymentDataObject */
      $paymentDataObject = $buildSubject['payment'];
      $order = $paymentDataObject->getOrder();
       $items = [];
      /**
       * @var  $key
       * @var OrderItemInterface $item
       */
        foreach ($order->getItems() as $key => $item) {
          $items['lineItem'][]= [
              'itemId' => (string) $key,
              'name' => substr($item->getName(),0, 31),
              'description' => substr($item->getDescription(),0, 31),
              'quantity' => $item->getQtyOrdered(),
              'unitPrice' => $item->getPrice()
          ];

      }

      return [
          'lineItems' => $items
      ];
    }
}