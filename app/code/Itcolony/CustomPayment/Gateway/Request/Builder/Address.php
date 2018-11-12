<?php
/**
 * Created by PhpStorm.
 * User: liyassoladogun
 * Date: 10/29/18
 * Time: 3:17 PM
 */

namespace Itcolony\CustomPayment\Gateway\Request\Builder;


use Magento\Payment\Gateway\Data\AddressAdapterInterface;
use Magento\Payment\Gateway\Data\PaymentDataObjectInterface;
use Magento\Payment\Gateway\Request\BuilderInterface;

class Address implements BuilderInterface
{
  public function build(array $buildSubject)
  {
      /** @var PaymentDataObjectInterface $paymentDataObject */
      $paymentDataObject = $buildSubject['payment'];

      $order = $paymentDataObject->getOrder();

      $billingAddress = $order->getBillingAddress();
      $shippingAddress = $order->getShippingAddress();

      $result = [
         'billTo' => $this->getFormattedAddress($billingAddress)
      ];

      if ($shippingAddress instanceof AddressAdapterInterface) {
          $result['shipTo' ] = $this->getFormattedAddress($shippingAddress);
      }

      return $result;
  }

    /**
     * @param AddressAdapterInterface $address
     * @return array
     */
  private function getFormattedAddress(AddressAdapterInterface $address) {
      return [
             'firstName' => $address->getFirstname(),
             'lastName' => $address->getLastname(),
             'company' => $address->getCompany() ?: '',
             'address' => $address->getStreetLine1() . $address->getStreetLine2(),
             'city' => $address->getCity(),
             'state' => $address->getRegionCode(),
              'zip' => $address->getPostcode(),
              'country' => $address->getCountryId()
      ];
  }
}