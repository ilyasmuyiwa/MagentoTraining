<?php
/**
 * Created by PhpStorm.
 * User: liyassoladogun
 * Date: 11/8/18
 * Time: 6:45 PM
 */

namespace Itcolony\CustomPayment\Gateway\Response;


interface ResponseFields
{
    const TRANSACTION_RESPONSE = 'transactionResponse';
    const RESPONSE_CODE = 'responseCode';
    const AUTH_CODE = 'authCode';
    const AVS_RESULT_CODE = 'avsResultCode';
    const CVV_RESULT_CODE = 'cvvResultCode';
    const CAVV_RESULT_CODE = 'cavvResultCode';
    const TRANS_ID = 'transId';
    const REF_TRANS_ID = 'refTransID';
    const TRANS_HASH = 'transHash';
    const TEST_REQUEST = 'testRequest';
    const ACCOUNT_NUMBER = 'accountNumber';
    const ACCOUNT_TYPE = 'accountType';
    const MESSAGES = 'messages';
    const MESSAGE_CODE = 'code';
    const MESSAGE_DESCRIPTION = 'description';
    const TRANSACTION_HASH_SHA2 = 'transHashSha2';
    const REFERENCE_ID = 'refId';


}