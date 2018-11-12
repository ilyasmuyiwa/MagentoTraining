<?php
/**
 * Created by PhpStorm.
 * User: liyassoladogun
 * Date: 10/29/18
 * Time: 1:37 PM
 */

namespace Itcolony\CustomPayment\Gateway\Request;


use Magento\Payment\Gateway\Request\BuilderInterface;

class RequestBuilder implements BuilderInterface
{
    /**
     * @var $builderInterface
     */
    private $builderComposite;

    public function  __construct(
        BuilderInterface $builder
    )
    {
        $this->builderComposite = $builder;
    }

    /**
     * @param array $buildSubject
     * @return array
     */
   public function build(array $buildSubject)
   {

       $value = [
           'createTransactionRequest' => [
               'merchantAuthentication' => [
                   'name' => '64T2eCVguH',
                   'transactionKey' => '752djE5ZS5Ry6B7t'
               ],
               'transactionRequest' => $this->builderComposite->build($buildSubject)
           ]
       ];

       return $value;
   }
}