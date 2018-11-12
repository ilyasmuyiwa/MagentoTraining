<?php
/**
 * Created by PhpStorm.
 * User: liyassoladogun
 * Date: 11/12/18
 * Time: 11:13 AM
 */

namespace Itcolony\CustomPayment\Gateway\Response;


use Magento\Payment\Gateway\Data\PaymentDataObjectInterface;
use Magento\Payment\Gateway\Response\HandlerInterface;
use Magento\Sales\Model\Order\Payment;

class TransactionAdditonalInfoHandler implements HandlerInterface
{
    /**
     * @var array
     */
    private $transactionAdditionalInfo = [
        ResponseFields::RESPONSE_CODE => 'response_code',
        ResponseFields::AUTH_CODE => 'auth_code',
        ResponseFields::AVS_RESULT_CODE => 'avs_result_code',
        ResponseFields::CVV_RESULT_CODE => 'cvv_result_code',
        ResponseFields::CAVV_RESULT_CODE => 'cavv_result_code',
        ResponseFields::TRANS_ID => 'transaction_id',
        ResponseFields::REF_TRANS_ID => 'ref_transaction_id',
        ResponseFields::TEST_REQUEST => 'test_request',
        ResponseFields::TRANS_HASH => 'transaction_hash',
        ResponseFields::ACCOUNT_NUMBER => 'account_number',
        ResponseFields::ACCOUNT_TYPE => 'account_type'
    ];

    /**
     * @param array $handlingSubject
     * @param array $response
     */
   public function handle(array $handlingSubject, array $response)
   {

       /** @var PaymentDataObjectInterface $paymentDataObject */
       $paymentDataObject = $handlingSubject['payment'];
       /** @var Payment $payment */
       $payment = $paymentDataObject->getPayment();
       $transactionResponse = $response[ResponseFields::TRANSACTION_RESPONSE];
       $transactionId = $transactionResponse[ResponseFields::TRANS_HASH];
       $payment->setCcTransId($transactionId);
       $payment->setLastTransId($transactionId);
       $payment->setTransactionId($transactionId);

       $rawDetails = [];

       if(isset($response[ResponseFields::REFERENCE_ID])) {
        $rawDetails[ResponseFields::REFERENCE_ID] = $response[ResponseFields::REFERENCE_ID];
       }

       foreach ($this->transactionAdditionalInfo as $key => $transactionKey) {
           if (isset($transactionResponse[$key])) {
               $payment->setTransactionAdditionalInfo($transactionKey, $transactionResponse[$key]);
               $rawDetails[$key] = $transactionResponse[$key];
           }
       }

       if (isset($transactionResponse[ResponseFields::MESSAGES])) {
           foreach ($transactionResponse[ResponseFields::MESSAGES] as $key => $message) {
               $payment->setTransactionAdditionalInfo(
                'messages_code_'.$key,
                $message[ResponseFields::MESSAGE_CODE]
               );
               $payment->setTransactionAdditionalInfo(
                   'messages_description_'.$key,
                   $message[ResponseFields::MESSAGE_DESCRIPTION]
               );
           }
       }
       $payment->setTransactionAdditionalInfo('raw_details_info', $rawDetails);
   }
}