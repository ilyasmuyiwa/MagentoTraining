<?php
/**
 * Created by PhpStorm.
 * User: liyassoladogun
 * Date: 10/31/18
 * Time: 9:23 AM
 */

namespace Itcolony\CustomPayment\Gateway\Converter;


use Magento\Payment\Gateway\Http\ConverterInterface;

class Converter
{
    /** @var ConverterInterface */
    private $converter;

    public function __construct(
        ConverterInterface $converter
    )
    {
        $this->converter = $converter;
    }

    /**
     * @param array $request
     * @return array
     * @throws \Magento\Payment\Gateway\Http\ConverterException
     */
    public function convert(array $request) {
        return $this->converter->convert($request);
    }

}