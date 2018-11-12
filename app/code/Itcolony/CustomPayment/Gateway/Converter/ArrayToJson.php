<?php
/**
 * Created by PhpStorm.
 * User: liyassoladogun
 * Date: 10/31/18
 * Time: 9:19 AM
 */

namespace Itcolony\CustomPayment\Gateway\Converter;
use Magento\Payment\Gateway\Http\ConverterInterface;
use Magento\Setup\Exception;

class ArrayToJson implements ConverterInterface
{
    /**
     * @param mixed $response
     * @return array
     */
    public function convert($response)
    {
        try {
            json_encode($response);
        } catch (\Exception $e) {
            $writer = new \Zend\Log\Writer\Stream(BP . '/var/log/testlog.log');
            $logger = new \Zend\Log\Logger();
            $logger->addWriter($writer);
            $logger->info($e->getMessage());
        }
        return json_encode($response);
    }
}