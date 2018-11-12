<?php
/**
 * Created by PhpStorm.
 * User: liyassoladogun
 * Date: 11/9/18
 * Time: 1:06 PM
 */

namespace Itcolony\CustomPayment\Gateway\Validator;


use Magento\Payment\Gateway\Validator\AbstractValidator;

class GeneralResponseValidator extends AbstractValidator
{
    /**
     * @param array $validationSubject
     * @return \Magento\Payment\Gateway\Validator\ResultInterface
     */
    public function validate(array $validationSubject)
    {
        $response = $validationSubject['response'];
        $isValid = true;
        $errorMessages = [];

        foreach ($this->getResponseValidators() as $validator) {
           $validationResult = $validator($response);
           if (!$validationResult[0]) {
               $isValid = $validationResult[0];
               $errorMessages = array_merge($errorMessages, $validationResult[1]);
           }

        }

        return $this->createResult($isValid, $errorMessages);
    }

    /**
     * @return array
     */
    private function getResponseValidators() {
        return [
            function ($response) {
              return [
                  isset($response['transactionResponse']) && is_array($response['transactionResponse']),
                  [__('Authorize.NET error response')]
              ];
            },

             function ($response)
             {
                 return [
                     isset($response['messages']['resultCode']) && 'Ok' === $response['messages']['resultCode'],
                     [__('Authorize.NET error response')]

                 ];
             },
            function ($response){
                return [
                    empty($response['transactionResponse']['errors']),
                    [__('Authorize.NET error response')]

                ];
            }

        ];
    }

}