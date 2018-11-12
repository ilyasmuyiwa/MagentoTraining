<?php
/**
 * Created by PhpStorm.
 * User: liyassoladogun
 * Date: 11/5/18
 * Time: 12:05 PM
 */

namespace Itcolony\CustomPayment\Logger;


class Handler extends \Magento\Framework\Logger\Handler\Base
{
    /**
     * Logging level
     * @var int
     */
    protected $loggerType = Logger::INFO;

    /**
     * File name
     * @var string
     */
    protected $fileName = '/var/log/custom_payment.log';
}