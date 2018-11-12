<?php
/**
 * Created by PhpStorm.
 * User: liyassoladogun
 * Date: 10/30/18
 * Time: 2:49 PM
 */

namespace Itcolony\CustomPayment\Gateway\Http;


use Magento\Framework\HTTP\ZendClientFactory;
use Magento\Payment\Gateway\Http\ClientException;
use Magento\Payment\Gateway\Http\ClientInterface;
use Magento\Payment\Gateway\Http\ConverterException;
use Magento\Payment\Gateway\Http\ConverterInterface;
use Magento\Payment\Gateway\Http\TransferInterface;
use Magento\Payment\Model\Method\Logger;
use Itcolony\CustomPayment\Logger\Logger as newLogger;
use Magento\Setup\Exception;

class Client implements ClientInterface
{
    /**
     * @var ZendClientFactory
     */
    private $clientFactory;
    /**
     * @var ConverterInterface
     */
    private $converter;

    /**
     * @var Logger
     */
    private $logger;
    protected $curl;
    protected $newLogger;

    public function __construct(
        \Magento\Framework\HTTP\Client\Curl $curl,
        ZendClientFactory $clientFactory,
        Logger $logger,
        newLogger $newLogger,
       ConverterInterface $converter = null
    )
    {
        $this->clientFactory = $clientFactory;
        $this->logger = $logger;
        $this->converter = $converter;
        $this->curl = $curl;
        $this->newLogger = $newLogger;
    }

    /**
     * @param TransferInterface $transferObject
     * @return array
     * @throws \Magento\Payment\Gateway\Http\ConverterException
     * @throws \Zend_Http_Client_Exception
     */
    public function placeRequest(TransferInterface $transferObject)
    {

        $log = [
            'request_uri' => $transferObject->getUri(),
            'request'    => $this->converter
                         ? $this->converter->convert($transferObject->getBody()):
                $transferObject->getBody()
        ];
        $this->newLogger->info('Payment Log'.print_r($log, true));

        /** ZendClent $client */
        $client = $this->clientFactory->create();
        try {
            /* Not working cos of SSL
             * Using Direct Curl
             * $client->setConfig($transferObject->getClientConfig());
            $client->setMethod($transferObject->getMethod());
            $client->setRawData($transferObject->getBody(), 'application/json');
            $client->setHeaders($transferObject->getHeaders());
            $client->setUrlEncodeBody($transferObject->shouldEncode());
            $client->setUri($transferObject->getUri());

            $response = $client->request();*/
            $timeout = 30;


            $newch = curl_init($transferObject->getUri());
            curl_setopt($newch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($newch, CURLOPT_POSTFIELDS, $transferObject->getBody());
            curl_setopt($newch,CURLOPT_CONNECTTIMEOUT,$timeout);
            curl_setopt($newch, CURLOPT_HEADER, false);
            curl_setopt($newch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($newch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($newch, CURLOPT_RETURNTRANSFER, true);
            $results = curl_exec($newch);
            $resultArray = $this->converter
                      ? $this->converter->convert($results): [$results];

              $log['response'] = $resultArray;
        } catch (\Exception $exception) {
        } finally {

            $this->newLogger->info('Payment Log'.print_r($log, true));
            //$this->logger->debug(var_export($result, true));
        }

        return $resultArray;
    }


}