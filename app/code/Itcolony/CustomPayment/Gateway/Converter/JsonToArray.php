<?php
/**
 * Created by PhpStorm.
 * User: liyassoladogun
 * Date: 10/30/18
 * Time: 5:28 PM
 */

namespace Itcolony\CustomPayment\Gateway\Converter;


use Magento\Payment\Gateway\Http\ConverterInterface;

class JsonToArray implements ConverterInterface
{
    /**
     * @var
     */

    private $serializer;

    /**
     * @param string $response
     * @return string
     */
    public function convert($response)
   {     $response = $this->remove_utf8_bom($response);
       $responseArray = json_decode($response, TRUE);
       return $responseArray;
   }

    public function remove_utf8_bom($text){
        $bom = pack('H*','EFBBBF');
        $text = preg_replace("/^$bom/", '', $text);
        return $text;
    }

}