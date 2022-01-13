<?php

namespace App\Http\Controllers\Soap;

use SoapClient;
use SoapFault;

class InstanceSoapClient extends SoapController
{
    /**
     * @throws SoapFault
     */
    public static function init(): SoapClient
    {
        $wsdlUrl = self::getWsdl();
        $soapClientOptions = [
            'stream_context' => self::generateContext(),
            'cache_wsdl'     => WSDL_CACHE_NONE,
            'Content-Type'   => 'application/soap+xml',
            'charset'        => 'UTF-8',
            'soap_version'   => SOAP_1_2,
            'verifypeer'     => FALSE,
            'verifyhost'     => TRUE,
            'trace'          => 1,
            'exceptions'     => 1,
        ];

        return new SoapClient($wsdlUrl, $soapClientOptions);
    }
}
