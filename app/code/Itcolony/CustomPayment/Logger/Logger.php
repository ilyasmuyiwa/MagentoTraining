<?php
/**
 * Created by PhpStorm.
 * User: liyassoladogun
 * Date: 11/5/18
 * Time: 12:04 PM
 */

namespace Itcolony\CustomPayment\Logger;


class Logger extends \Monolog\Logger
{

    public function paymentLog ($log) {
        return parent::info(implode(" ", $log), []);
    }

}