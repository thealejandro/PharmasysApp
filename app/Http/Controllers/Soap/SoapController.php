<?php

namespace App\Http\Controllers\Soap;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PHPUnit\Util\Json;

class SoapController extends Controller
{
    protected static $options;
    protected static $context;
    protected static $wsdl;

    public static function setWSDL($url) {
        return self::$wsdl = $url;
    }

    public static function getWSDL() {
        return self::$wsdl;
    }

    protected static function generateContext(){
        self::$options = [
            'http' => [
                'user_agent' => 'PHPSoapClient'
            ],
            'ssl' => [
                'verify_peer'       => false,
                'verify_peer_name'  => false,
                'allow_self_signed' => true,
            ]
        ];

        return self::$context = stream_context_create(self::$options);
    }

    public function loadXmlStringAsArray($xmlString): array
    {
        $array = (array) @simplexml_load_string($xmlString);
        if(!$array){
            $array = (array) @json_decode($xmlString, true);
        } else{
            $array = (array) @json_decode(json_encode($array), true);
        }
        return $array;
    }
}
