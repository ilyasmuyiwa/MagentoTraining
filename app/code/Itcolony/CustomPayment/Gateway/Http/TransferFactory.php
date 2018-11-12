<?php
/**
 * Created by PhpStorm.
 * User: liyassoladogun
 * Date: 10/30/18
 * Time: 2:04 PM
 */

namespace Itcolony\CustomPayment\Gateway\Http;


use Itcolony\CustomPayment\Gateway\Converter\Converter;
use Magento\Payment\Gateway\Http\TransferBuilder;
use Magento\Payment\Gateway\Http\TransferFactoryInterface;

class TransferFactory implements TransferFactoryInterface
{
    /**
     * @var TransferBuilder
     */
    private $transferBuilder;

    /**
     * @var Converter
     */
    private $converter;

    /**
     * TransferFactory constructor.
     * @param TransferBuilder $transferBuilder
     */
    public function __construct(
        TransferBuilder $transferBuilder,
        Converter $converter
    )
    {
        $this->transferBuilder = $transferBuilder;
        $this->converter = $converter;
    }

    public function create(array $request)
    {
        $transfer = $this->transferBuilder
            ->setUri('https://apitest.authorize.net/xml/v1/request.api')
            ->setMethod('POST')
            ->setBody($this->converter->convert($request))
            ->setHeaders(['Content-Type' => 'application/json'])
            ->build();
      return $transfer;

    }
}