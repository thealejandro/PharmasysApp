<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Soap\InstanceSoapClient;
use App\Http\Controllers\Soap\SoapController;
use App\Models\FelInvoices;
use App\Models\Stores;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use League\CommonMark\Node\Block\Document;
use phpDocumentor\Reflection\Types\Object_;
use Psy\Util\Json;
use SoapFault;

class SoapFELController extends SoapController
{

    public function verifynit($nitReceptor)
    {
        try {
            if ($nitReceptor !== "CF") {
//                self::setWSDL('https://app.corposistemasgt.com/getnitPruebas/ConsultaNIT.asmx?wsdl');  //Servicio de Pruebas
                self::setWSDL('https://app.corposistemasgt.com/getnit/ConsultaNIT.asmx?wsdl');
                $service = InstanceSoapClient::init();

                $query = $service->getNIT(['vNIT' => $nitReceptor, 'Entity' => getenv("FEL_NIT"), 'Requestor' => getenv("FEL_REQUESTOR")]);
                $resp = get_object_vars($query->getNITResult);
                $nit = $resp['Response'];

                return response()->json(["nit"=>$nit]);
            }
        } catch (SoapFault $e) {
            return $e->getMessage();
        }
    }

    public function getDTE()
    {
        try {
            self::setWSDL('https://app.corposistemasgt.com/webservicefronttest/factwsfront.asmx?wsdl');
            $service = InstanceSoapClient::init();

            $query = $service->RequestTransaction([
                'Requestor' => '8A454E3F-CEA1-41D8-A13A-A748A4891BBF',
                'Transaction' => 'GET_DOCUMENT',
                'Country' => 'GT',
                'Entity' => '800000001026',
                'User' => '8A454E3F-CEA1-41D8-A13A-A748A4891BBF',
                'UserName' => 'ADMINISTRADOR',
                'Data1' => '5AC1F2F2-40CF-4703-8116-1AC282EB1306',
                'Data2' => '',
                'Data3' => 'XML']);

            $resp = $query->RequestTransactionResult;

            $documentcodify = $query->RequestTransactionResult->ResponseData->ResponseData1;
            $documentdecodify = (string) htmlspecialchars(base64_decode($documentcodify), ENT_XML1, 'UTF-8');
/*            $documentdecodify = '<?xml version="1.0" encoding="utf-8"?><dte:GTDocumento xmlns:ds="http://www.w3.org/2000/09/xmldsig#" xmlns:cfc="http://www.sat.gob.gt/dte/fel/CompCambiaria/0.1.0" xmlns:cno="http://www.sat.gob.gt/face2/ComplementoReferenciaNota/0.1.0" xmlns:cex="http://www.sat.gob.gt/face2/ComplementoExportaciones/0.1.0" xmlns:cfe="http://www.sat.gob.gt/face2/ComplementoFacturaEspecial/0.1.0" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:cca="http://www.sat.gob.gt/face2/CobroXCuentaAjena/0.1.0" Version="0.1" xmlns:dte="http://www.sat.gob.gt/dte/fel/0.2.0"><dte:SAT ClaseDocumento="dte"><dte:DTE ID="DatosCertificados"><dte:DatosEmision ID="DatosEmision"><dte:DatosGenerales Tipo="FACT" FechaHoraEmision="2021-12-24T15:57:34" CodigoMoneda="GTQ" /><dte:Emisor NITEmisor="800000001026" NombreEmisor="TALLER DE ZAPATERIA ALLAN ROSS" CodigoEstablecimiento="1" NombreComercial="Establecimiento1" AfiliacionIVA="GEN"><dte:DireccionEmisor><dte:Direccion>04 AVE. LTE. 157 COL. STA. MARTA 00-000   ZONA 19 </dte:Direccion><dte:CodigoPostal>01000</dte:CodigoPostal><dte:Municipio>GUATEMALA</dte:Municipio><dte:Departamento>GUATEMALA</dte:Departamento><dte:Pais>GT</dte:Pais></dte:DireccionEmisor></dte:Emisor><dte:Receptor IDReceptor="42412692" NombreReceptor="CHOC,,CAAL,OLGA,MARINA"><dte:DireccionReceptor><dte:Direccion>2DA  AVENIDA, , 6-42, , Zona: 6, COLONIA MUNICIPAL</dte:Direccion><dte:CodigoPostal>01005</dte:CodigoPostal><dte:Municipio>.</dte:Municipio><dte:Departamento>.</dte:Departamento><dte:Pais>GT</dte:Pais></dte:DireccionReceptor></dte:Receptor><dte:Frases><dte:Frase TipoFrase="1" CodigoEscenario="1" /></dte:Frases><dte:Items><dte:Item NumeroLinea="1" BienOServicio="B"><dte:Cantidad>1.0000000000</dte:Cantidad><dte:UnidadMedida>UNI</dte:UnidadMedida><dte:Descripcion>Compras</dte:Descripcion><dte:PrecioUnitario>200.000000</dte:PrecioUnitario><dte:Precio>200.000000</dte:Precio><dte:Descuento>0</dte:Descuento><dte:Impuestos><dte:Impuesto><dte:NombreCorto>IVA</dte:NombreCorto><dte:CodigoUnidadGravable>1</dte:CodigoUnidadGravable><dte:MontoGravable>178.571429</dte:MontoGravable><dte:MontoImpuesto>21.428571</dte:MontoImpuesto></dte:Impuesto></dte:Impuestos><dte:Total>200.000000</dte:Total></dte:Item></dte:Items><dte:Totales><dte:TotalImpuestos><dte:TotalImpuesto NombreCorto="IVA" TotalMontoImpuesto="21.428571" /></dte:TotalImpuestos><dte:GranTotal>200.000001</dte:GranTotal></dte:Totales></dte:DatosEmision><dte:Certificacion><dte:NITCertificador>108151654</dte:NITCertificador><dte:NombreCertificador>CORPOSISTEMAS, SOCIEDAD ANONIMA</dte:NombreCertificador><dte:NumeroAutorizacion Serie="PRUEBAS" Numero="1087325955">5AC1F2F2-40CF-4703-8116-1AC282EB1306</dte:NumeroAutorizacion><dte:FechaHoraCertificacion>2021-12-24T15:57:34</dte:FechaHoraCertificacion></dte:Certificacion></dte:DTE><dte:Adenda><Adicionales xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns="Schema-totalletras"><TotalEnLetras>DOSCIENTOS QUETZALES EXACTOS </TotalEnLetras></Adicionales></dte:Adenda></dte:SAT><ds:Signature xmlns:ds="http://www.w3.org/2000/09/xmldsig#" Id="Signature-a8f75f34-b28e-4322-9534-b749392f1812"><ds:SignedInfo><ds:CanonicalizationMethod Algorithm="http://www.w3.org/TR/2001/REC-xml-c14n-20010315" /><ds:SignatureMethod Algorithm="http://www.w3.org/2001/04/xmldsig-more#rsa-sha256" /><ds:Reference Id="Reference-e0671322-0f3c-45fe-b91e-aa4a39a01727" URI="#DatosEmision"><ds:Transforms><ds:Transform Algorithm="http://www.w3.org/TR/2001/REC-xml-c14n-20010315" /></ds:Transforms><ds:DigestMethod Algorithm="http://www.w3.org/2001/04/xmlenc#sha256" /><ds:DigestValue>aZKGwFaCp5mE/PWrhTRP1AhvYwylI6+AcZEcE1DD4eE=</ds:DigestValue></ds:Reference><ds:Reference Id="ReferenceKeyInfo-Signature-a8f75f34-b28e-4322-9534-b749392f1812" URI="#KeyInfoId-Signature-a8f75f34-b28e-4322-9534-b749392f1812"><ds:DigestMethod Algorithm="http://www.w3.org/2001/04/xmlenc#sha256" /><ds:DigestValue>ZytuKE5X0jfs72rdRK2bcJmk7aiiWBZJsh9NZdOtY/4=</ds:DigestValue></ds:Reference><ds:Reference Type="http://uri.etsi.org/01903#SignedProperties" URI="#SignedProperties-Signature-a8f75f34-b28e-4322-9534-b749392f1812"><ds:DigestMethod Algorithm="http://www.w3.org/2001/04/xmlenc#sha256" /><ds:DigestValue>TCDszzx3wDGyMoY32a7DxUKLF68OmvbRcaNHjrdlIqA=</ds:DigestValue></ds:Reference></ds:SignedInfo><ds:SignatureValue Id="SignatureValue-a8f75f34-b28e-4322-9534-b749392f1812">XAHmFvv+6O+cQT5JHMiGnfsplynaGr32xcfek1rzOF1Wwe+j0yubRXNeij6MbzHWcq15vTs+O6fpDWiQsSZP9OiVueKFRGGS7iHzZ+Co+6cy4mykWSpZsiRb/NrG6fZInGaoUSoiZgOtMlaoU0WWamYRzoVwQk422qsNnleUt5Q+OIgzUwQoXuJY0U0KaIjFJqU4mWHFbjEqsk727CF9rB1XHPp+qoUlFOo9gIGPl1jh5hWmnmhFCGsiEUgE4BU8i3KjzVhNWfDul6gIfC4jHUMYNpzYmJIkdd2mIz2eicM2fOjkhnWoP5qweoiLk+d23mWccVM8b91weUGTv7CMWg==</ds:SignatureValue><ds:KeyInfo Id="KeyInfoId-Signature-a8f75f34-b28e-4322-9534-b749392f1812"><ds:X509Data><ds:X509Certificate>MIIDSjCCAjKgAwIBAgIIbgazXB/FpUIwDQYJKoZIhvcNAQELBQAwLDELMAkGA1UEAwwCQ0ExEDAOBgNVBAoMB1NBVCBERVYxCzAJBgNVBAYTAkdUMB4XDTE4MTAyNjE0MjYzMFoXDTIwMTAyNTE0MjYzMFowJzEQMA4GA1UEAwwHNzMzNTg4MTETMBEGA1UECgwKc2F0LmdvYi5ndDCCASIwDQYJKoZIhvcNAQEBBQADggEPADCCAQoCggEBALYXl/QXh/Gl1VIXSRmI8TPCSfUH/DSeINUWftTQzZbeK//pRQj9VlLMYW9ZFdRGwh6J6BLBZ4CaKxCIQ76ixbvt0+zS9sTcbCSP04ZgMPBmC9dndbeBzGwARdJd/KFrB3bYQGVqlK7qkaZi4qegOXg+1D5p3PdHGAixgIR5Siwo4Yk1dcN7RAfZdQ/BYRLF1VTBzvcadblSth1hf34+z1GW4E7yr9QsUbpamcr16VjEzfniZXhof/EgIiv6G2tWhHhhkfmMgTsWTy0PheqZkqmB9i2OYPA/3XpTVJlocJmaZFArYk9Qv8C4okMn1XvQClla7pLsfRA78tdVjW3edd8CAwEAAaN1MHMwDAYDVR0TAQH/BAIwADAfBgNVHSMEGDAWgBQt1q3Lx6fopv2U8TdMLd1FwSKGsjATBgNVHSUEDDAKBggrBgEFBQcDATAdBgNVHQ4EFgQUjZ9JYwH7gIOy0Ul9l2ZA/P0oB1wwDgYDVR0PAQH/BAQDAgWgMA0GCSqGSIb3DQEBCwUAA4IBAQCJVDl3u3fc/dAnOPKck0DLpGKcP04SagMF65D2mj1bZPwsWBQDmMdv2lw8zcqgWBt5fu2kZzaA0+ku7PqxfORcgUMuBYQ467lymi4iSl4nLQYx0PoqcWmGMIDdSSJFTzhO5ajAzQl0pGfLkcbkli0wLwj8moFNjWvMKMVU9j0YmeKHb6TMH+49XDxhqCkqU7Eol4Q4NGso0ZjTvZYRFDl2mRoAdTLfc9etpd8L8oi+MrlNTsjyyV4N+lNKbJeCH+e1NNftYMDkmkVAC4XNCUKDu0IjLcYUz2NG2sq86XygiSnComerw0cWkLUM1zvKuvQUaTk0AYpfZgE1ztm1C/Ez</ds:X509Certificate></ds:X509Data><ds:KeyValue><ds:RSAKeyValue><ds:Modulus>theX9BeH8aXVUhdJGYjxM8JJ9Qf8NJ4g1RZ+1NDNlt4r/+lFCP1WUsxhb1kV1EbCHonoEsFngJorEIhDvqLFu+3T7NL2xNxsJI/ThmAw8GYL12d1t4HMbABF0l38oWsHdthAZWqUruqRpmLip6A5eD7UPmnc90cYCLGAhHlKLCjhiTV1w3tEB9l1D8FhEsXVVMHO9xp1uVK2HWF/fj7PUZbgTvKv1CxRulqZyvXpWMTN+eJleGh/8SAiK/oba1aEeGGR+YyBOxZPLQ+F6pmSqYH2LY5g8D/delNUmWhwmZpkUCtiT1C/wLiiQyfVe9AKWVrukux9EDvy11WNbd513w==</ds:Modulus><ds:Exponent>AQAB</ds:Exponent></ds:RSAKeyValue></ds:KeyValue></ds:KeyInfo><ds:Object Id="XadesObjectId-b9044c28-c0e0-4622-8e44-7b355ff622c6"><xades:QualifyingProperties xmlns:xades="http://uri.etsi.org/01903/v1.3.2#" Id="QualifyingProperties-5fe9e9b4-8b59-4a06-8dc7-6572ac42e984" Target="#Signature-a8f75f34-b28e-4322-9534-b749392f1812"><xades:SignedProperties Id="SignedProperties-Signature-a8f75f34-b28e-4322-9534-b749392f1812"><xades:SignedSignatureProperties><xades:SigningTime>2021-12-24T15:57:34-06:00</xades:SigningTime><xades:SigningCertificate><xades:Cert><xades:CertDigest><ds:DigestMethod Algorithm="http://www.w3.org/2001/04/xmlenc#sha256" /><ds:DigestValue>14bvYbs9ga8cyHFXJ8Agpb48KJ+GT2OlljZBCKYclXw=</ds:DigestValue></xades:CertDigest><xades:IssuerSerial><ds:X509IssuerName>C=GT, O=SAT DEV, CN=CA</ds:X509IssuerName><ds:X509SerialNumber>7928221402283746626</ds:X509SerialNumber></xades:IssuerSerial></xades:Cert></xades:SigningCertificate></xades:SignedSignatureProperties><xades:SignedDataObjectProperties><xades:DataObjectFormat ObjectReference="#Reference-e0671322-0f3c-45fe-b91e-aa4a39a01727"><xades:MimeType>text/xml</xades:MimeType><xades:Encoding>UTF-8</xades:Encoding></xades:DataObjectFormat></xades:SignedDataObjectProperties></xades:SignedProperties></xades:QualifyingProperties></ds:Object></ds:Signature><ds:Signature xmlns:ds="http://www.w3.org/2000/09/xmldsig#" Id="Signature-54f0605a-8bbb-4ab4-ab89-a63cc35a29f2"><ds:SignedInfo><ds:CanonicalizationMethod Algorithm="http://www.w3.org/TR/2001/REC-xml-c14n-20010315" /><ds:SignatureMethod Algorithm="http://www.w3.org/2001/04/xmldsig-more#rsa-sha256" /><ds:Reference Id="Reference-f2bd6693-995e-4e97-9531-5a65edec4a41" URI="#DatosCertificados"><ds:Transforms><ds:Transform Algorithm="http://www.w3.org/TR/2001/REC-xml-c14n-20010315" /></ds:Transforms><ds:DigestMethod Algorithm="http://www.w3.org/2001/04/xmlenc#sha256" /><ds:DigestValue>wx/qZZCijmyAYdZtNqhFWSE3KuxEy1hj8dspXlPUT9Y=</ds:DigestValue></ds:Reference><ds:Reference Id="ReferenceKeyInfo-Signature-54f0605a-8bbb-4ab4-ab89-a63cc35a29f2" URI="#KeyInfoId-Signature-54f0605a-8bbb-4ab4-ab89-a63cc35a29f2"><ds:DigestMethod Algorithm="http://www.w3.org/2001/04/xmlenc#sha256" /><ds:DigestValue>NG8Fjqa7eQVtGkAE3Iuc+EmnzfDCAT+w4gISS5jWtFI=</ds:DigestValue></ds:Reference><ds:Reference Type="http://uri.etsi.org/01903#SignedProperties" URI="#SignedProperties-Signature-54f0605a-8bbb-4ab4-ab89-a63cc35a29f2"><ds:DigestMethod Algorithm="http://www.w3.org/2001/04/xmlenc#sha256" /><ds:DigestValue>ysesbmgX2wj1VwDGnNyH+6bDWp1MUyimgBqjqs4gHB0=</ds:DigestValue></ds:Reference></ds:SignedInfo><ds:SignatureValue Id="SignatureValue-54f0605a-8bbb-4ab4-ab89-a63cc35a29f2">an56akJ0Q3/rEgBlC9gebJ7ca6MkRAoBLpFqeOiC/8dgBYLg2X9maXcohZnjYRvibVPtTZ4YtBuEAV6L7lTlmeVVfyKXgSxsrkxJlQxyiVOeGEHi3sz37MLC3G/7H/Y4FlYNihuAQOgBSJRaC7rUBIH+EoRgEK68KWqdNKD4uo2pBfVaLlTKVvhJkAwUvunu74rXRT/+w82Dznf/dWmqRBXKjcJH6ODV5cLclmthENNx0STiEBBMguRvzFny9KmpjOLUW/ExHjvZvgCId8Ti3u7ppBFH/FfnvV+B//zLvQRiXAzLy8WNN/M5RrNOcWTjhAJyWEHpT6S+jxm5as3ChA==</ds:SignatureValue><ds:KeyInfo Id="KeyInfoId-Signature-54f0605a-8bbb-4ab4-ab89-a63cc35a29f2"><ds:X509Data><ds:X509Certificate>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</ds:X509Certificate></ds:X509Data><ds:KeyValue><ds:RSAKeyValue><ds:Modulus>vwaqlct+/i+KvgVomXsVLGH4qo+03eJRY9C8R3ul7iOQ9+AXu26LhpkXwyZvUnKcUJywPjtaTLiyr/GLVHNm4lSATrwmZnF6I7OO75WhJqYXACFyQ9jYO08MIYc2WohLN2pMepa8sMaIedpJGXELiXvllHSS6wa2jVktX7YD8pCdKSHvBXXFdR9huYImr3VJ1LHh4T/LciuJJ7y50SSzdyLjvbpuhEj+fAxw64dKZK0SgDGOjKmDO7YTUJfAf+nEoRw8dnLjlS/5GeJTefYBK8YLqF5bYMYKill1FgVF3AY2o5bRktHtYxiuN4849BKLxZnq3w5UYogndgq34JZCNQ==</ds:Modulus><ds:Exponent>Aw==</ds:Exponent></ds:RSAKeyValue></ds:KeyValue></ds:KeyInfo><ds:Object Id="XadesObjectId-37015f5d-b7ac-4e52-9c61-bbd406a58bdf"><xades:QualifyingProperties xmlns:xades="http://uri.etsi.org/01903/v1.3.2#" Id="QualifyingProperties-657c282f-7863-4cdb-971e-a2441c0900a0" Target="#Signature-54f0605a-8bbb-4ab4-ab89-a63cc35a29f2"><xades:SignedProperties Id="SignedProperties-Signature-54f0605a-8bbb-4ab4-ab89-a63cc35a29f2"><xades:SignedSignatureProperties><xades:SigningTime>2021-12-24T15:57:34-06:00</xades:SigningTime><xades:SigningCertificate><xades:Cert><xades:CertDigest><ds:DigestMethod Algorithm="http://www.w3.org/2001/04/xmlenc#sha256" /><ds:DigestValue>p7/DhaACMDY+ikMN8JeAkkX/Jf4iYVeC98/+6F+dHC0=</ds:DigestValue></xades:CertDigest><xades:IssuerSerial><ds:X509IssuerName>CN=AC SUB CERTICAMARA, O=CERTICAMARA S.A, OU=NIT 830084433-7, C=CO, S=DISTRITO CAPITAL, L=BOGOTA, STREET=www.certicamara.com</ds:X509IssuerName><ds:X509SerialNumber>4027847649684118354734956758906464042</ds:X509SerialNumber></xades:IssuerSerial></xades:Cert></xades:SigningCertificate></xades:SignedSignatureProperties><xades:SignedDataObjectProperties><xades:DataObjectFormat ObjectReference="#Reference-f2bd6693-995e-4e97-9531-5a65edec4a41"><xades:MimeType>text/xml</xades:MimeType><xades:Encoding>UTF-8</xades:Encoding></xades:DataObjectFormat></xades:SignedDataObjectProperties></xades:SignedProperties></xades:QualifyingProperties></ds:Object></ds:Signature></dte:GTDocumento>';*/
//            $documentdecodify = tidy_repair_string($documentdecodify, ['input-xml' => 1, 'output-xml' => 1, 'wrap' => 0]);

//            $documentdecodify = str_replace(['&lt;', '&gt;', '&amp;', '&apos;', '&quot;', '/[\x-\x8\xb-\xc\xe-\x1f]/', 'xmlns="Schema-totalletras"'], ['<','>','&', "'", '"', '', ''], $documentdecodify);

//            libxml_use_internal_errors(TRUE);
//            $documentdecodify = simplexml_load_string($documentdecodify, "SimpleXMLElement");
//            $tidydoc = tidy_parse_string($documentdecodify, ['output-xml' => TRUE, 'wrap' => FALSE]);
//            $docxml = new \DOMDocument();
//            $docxml->loadXML($documentdecodify);
//            return $docxml;

//            $documentdecodify = base64_decode($documentcodify);
//            $documentdecodify = htmlspecialchars_decode($documentdecodify);
//            $documentdecodify = $this->loadXmlStringAsArray($documentdecodify);

/*            $xmlsdocument = '<?xml version="1.0" encoding="utf-8"?><dte:GTDocumento xmlns:ds="http://www.w3.org/2000/09/xmldsig#" xmlns:cfc="http://www.sat.gob.gt/dte/fel/CompCambiaria/0.1.0" xmlns:cno="http://www.sat.gob.gt/face2/ComplementoReferenciaNota/0.1.0" xmlns:cex="http://www.sat.gob.gt/face2/ComplementoExportaciones/0.1.0" xmlns:cfe="http://www.sat.gob.gt/face2/ComplementoFacturaEspecial/0.1.0" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:cca="http://www.sat.gob.gt/face2/CobroXCuentaAjena/0.1.0" Version="0.1" xmlns:dte="http://www.sat.gob.gt/dte/fel/0.2.0"><dte:SAT ClaseDocumento="dte"><dte:DTE ID="DatosCertificados"><dte:DatosEmision ID="DatosEmision"><dte:DatosGenerales Tipo="FACT" FechaHoraEmision="2021-12-24T15:57:34" CodigoMoneda="GTQ" /><dte:Emisor NITEmisor="800000001026" NombreEmisor="TALLER DE ZAPATERIA ALLAN ROSS" CodigoEstablecimiento="1" NombreComercial="Establecimiento1" AfiliacionIVA="GEN"><dte:DireccionEmisor><dte:Direccion>04 AVE. LTE. 157 COL. STA. MARTA 00-000 ZONA 19 </dte:Direccion><dte:CodigoPostal>01000</dte:CodigoPostal><dte:Municipio>GUATEMALA</dte:Municipio><dte:Departamento>GUATEMALA</dte:Departamento><dte:Pais>GT</dte:Pais></dte:DireccionEmisor></dte:Emisor><dte:Receptor IDReceptor="42412692" NombreReceptor="CHOC,,CAAL,OLGA,MARINA"><dte:DireccionReceptor><dte:Direccion>2DA AVENIDA, , 6-42, , Zona: 6, COLONIA MUNICIPAL</dte:Direccion><dte:CodigoPostal>01005</dte:CodigoPostal><dte:Municipio>.</dte:Municipio><dte:Departamento>.</dte:Departamento><dte:Pais>GT</dte:Pais></dte:DireccionReceptor></dte:Receptor><dte:Frases><dte:Frase TipoFrase="1" CodigoEscenario="1" /></dte:Frases><dte:Items><dte:Item NumeroLinea="1" BienOServicio="B"><dte:Cantidad>1.0000000000</dte:Cantidad><dte:UnidadMedida>UNI</dte:UnidadMedida><dte:Descripcion>Compras</dte:Descripcion><dte:PrecioUnitario>200.000000</dte:PrecioUnitario><dte:Precio>200.000000</dte:Precio><dte:Descuento>0</dte:Descuento><dte:Impuestos><dte:Impuesto><dte:NombreCorto>IVA</dte:NombreCorto><dte:CodigoUnidadGravable>1</dte:CodigoUnidadGravable><dte:MontoGravable>178.571429</dte:MontoGravable><dte:MontoImpuesto>21.428571</dte:MontoImpuesto></dte:Impuesto></dte:Impuestos><dte:Total>200.000000</dte:Total></dte:Item></dte:Items><dte:Totales><dte:TotalImpuestos><dte:TotalImpuesto NombreCorto="IVA" TotalMontoImpuesto="21.428571" /></dte:TotalImpuestos><dte:GranTotal>200.000001</dte:GranTotal></dte:Totales></dte:DatosEmision><dte:Certificacion><dte:NITCertificador>108151654</dte:NITCertificador><dte:NombreCertificador>CORPOSISTEMAS, SOCIEDAD ANONIMA</dte:NombreCertificador><dte:NumeroAutorizacion Serie="PRUEBAS" Numero="1087325955">5AC1F2F2-40CF-4703-8116-1AC282EB1306</dte:NumeroAutorizacion><dte:FechaHoraCertificacion>2021-12-24T15:57:34</dte:FechaHoraCertificacion></dte:Certificacion></dte:DTE><dte:Adenda><Adicionales xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns="Schema-totalletras"><TotalEnLetras>DOSCIENTOS QUETZALES EXACTOS </TotalEnLetras></Adicionales></dte:Adenda></dte:SAT><ds:Signature xmlns:ds="http://www.w3.org/2000/09/xmldsig#" Id="Signature-a8f75f34-b28e-4322-9534-b749392f1812"><ds:SignedInfo><ds:CanonicalizationMethod Algorithm="http://www.w3.org/TR/2001/REC-xml-c14n-20010315" /><ds:SignatureMethod Algorithm="http://www.w3.org/2001/04/xmldsig-more#rsa-sha256" /><ds:Reference Id="Reference-e0671322-0f3c-45fe-b91e-aa4a39a01727" URI="#DatosEmision"><ds:Transforms><ds:Transform Algorithm="http://www.w3.org/TR/2001/REC-xml-c14n-20010315" /></ds:Transforms><ds:DigestMethod Algorithm="http://www.w3.org/2001/04/xmlenc#sha256" /><ds:DigestValue>aZKGwFaCp5mE/PWrhTRP1AhvYwylI6+AcZEcE1DD4eE=</ds:DigestValue></ds:Reference><ds:Reference Id="ReferenceKeyInfo-Signature-a8f75f34-b28e-4322-9534-b749392f1812" URI="#KeyInfoId-Signature-a8f75f34-b28e-4322-9534-b749392f1812"><ds:DigestMethod Algorithm="http://www.w3.org/2001/04/xmlenc#sha256" /><ds:DigestValue>ZytuKE5X0jfs72rdRK2bcJmk7aiiWBZJsh9NZdOtY/4=</ds:DigestValue></ds:Reference><ds:Reference Type="http://uri.etsi.org/01903#SignedProperties" URI="#SignedProperties-Signature-a8f75f34-b28e-4322-9534-b749392f1812"><ds:DigestMethod Algorithm="http://www.w3.org/2001/04/xmlenc#sha256" /><ds:DigestValue>TCDszzx3wDGyMoY32a7DxUKLF68OmvbRcaNHjrdlIqA=</ds:DigestValue></ds:Reference></ds:SignedInfo><ds:SignatureValue Id="SignatureValue-a8f75f34-b28e-4322-9534-b749392f1812">XAHmFvv+6O+cQT5JHMiGnfsplynaGr32xcfek1rzOF1Wwe+j0yubRXNeij6MbzHWcq15vTs+O6fpDWiQsSZP9OiVueKFRGGS7iHzZ+Co+6cy4mykWSpZsiRb/NrG6fZInGaoUSoiZgOtMlaoU0WWamYRzoVwQk422qsNnleUt5Q+OIgzUwQoXuJY0U0KaIjFJqU4mWHFbjEqsk727CF9rB1XHPp+qoUlFOo9gIGPl1jh5hWmnmhFCGsiEUgE4BU8i3KjzVhNWfDul6gIfC4jHUMYNpzYmJIkdd2mIz2eicM2fOjkhnWoP5qweoiLk+d23mWccVM8b91weUGTv7CMWg==</ds:SignatureValue><ds:KeyInfo Id="KeyInfoId-Signature-a8f75f34-b28e-4322-9534-b749392f1812"><ds:X509Data><ds:X509Certificate>MIIDSjCCAjKgAwIBAgIIbgazXB/FpUIwDQYJKoZIhvcNAQELBQAwLDELMAkGA1UEAwwCQ0ExEDAOBgNVBAoMB1NBVCBERVYxCzAJBgNVBAYTAkdUMB4XDTE4MTAyNjE0MjYzMFoXDTIwMTAyNTE0MjYzMFowJzEQMA4GA1UEAwwHNzMzNTg4MTETMBEGA1UECgwKc2F0LmdvYi5ndDCCASIwDQYJKoZIhvcNAQEBBQADggEPADCCAQoCggEBALYXl/QXh/Gl1VIXSRmI8TPCSfUH/DSeINUWftTQzZbeK//pRQj9VlLMYW9ZFdRGwh6J6BLBZ4CaKxCIQ76ixbvt0+zS9sTcbCSP04ZgMPBmC9dndbeBzGwARdJd/KFrB3bYQGVqlK7qkaZi4qegOXg+1D5p3PdHGAixgIR5Siwo4Yk1dcN7RAfZdQ/BYRLF1VTBzvcadblSth1hf34+z1GW4E7yr9QsUbpamcr16VjEzfniZXhof/EgIiv6G2tWhHhhkfmMgTsWTy0PheqZkqmB9i2OYPA/3XpTVJlocJmaZFArYk9Qv8C4okMn1XvQClla7pLsfRA78tdVjW3edd8CAwEAAaN1MHMwDAYDVR0TAQH/BAIwADAfBgNVHSMEGDAWgBQt1q3Lx6fopv2U8TdMLd1FwSKGsjATBgNVHSUEDDAKBggrBgEFBQcDATAdBgNVHQ4EFgQUjZ9JYwH7gIOy0Ul9l2ZA/P0oB1wwDgYDVR0PAQH/BAQDAgWgMA0GCSqGSIb3DQEBCwUAA4IBAQCJVDl3u3fc/dAnOPKck0DLpGKcP04SagMF65D2mj1bZPwsWBQDmMdv2lw8zcqgWBt5fu2kZzaA0+ku7PqxfORcgUMuBYQ467lymi4iSl4nLQYx0PoqcWmGMIDdSSJFTzhO5ajAzQl0pGfLkcbkli0wLwj8moFNjWvMKMVU9j0YmeKHb6TMH+49XDxhqCkqU7Eol4Q4NGso0ZjTvZYRFDl2mRoAdTLfc9etpd8L8oi+MrlNTsjyyV4N+lNKbJeCH+e1NNftYMDkmkVAC4XNCUKDu0IjLcYUz2NG2sq86XygiSnComerw0cWkLUM1zvKuvQUaTk0AYpfZgE1ztm1C/Ez</ds:X509Certificate></ds:X509Data><ds:KeyValue><ds:RSAKeyValue><ds:Modulus>theX9BeH8aXVUhdJGYjxM8JJ9Qf8NJ4g1RZ+1NDNlt4r/+lFCP1WUsxhb1kV1EbCHonoEsFngJorEIhDvqLFu+3T7NL2xNxsJI/ThmAw8GYL12d1t4HMbABF0l38oWsHdthAZWqUruqRpmLip6A5eD7UPmnc90cYCLGAhHlKLCjhiTV1w3tEB9l1D8FhEsXVVMHO9xp1uVK2HWF/fj7PUZbgTvKv1CxRulqZyvXpWMTN+eJleGh/8SAiK/oba1aEeGGR+YyBOxZPLQ+F6pmSqYH2LY5g8D/delNUmWhwmZpkUCtiT1C/wLiiQyfVe9AKWVrukux9EDvy11WNbd513w==</ds:Modulus><ds:Exponent>AQAB</ds:Exponent></ds:RSAKeyValue></ds:KeyValue></ds:KeyInfo><ds:Object Id="XadesObjectId-b9044c28-c0e0-4622-8e44-7b355ff622c6"><xades:QualifyingProperties xmlns:xades="http://uri.etsi.org/01903/v1.3.2#" Id="QualifyingProperties-5fe9e9b4-8b59-4a06-8dc7-6572ac42e984" Target="#Signature-a8f75f34-b28e-4322-9534-b749392f1812"><xades:SignedProperties Id="SignedProperties-Signature-a8f75f34-b28e-4322-9534-b749392f1812"><xades:SignedSignatureProperties><xades:SigningTime>2021-12-24T15:57:34-06:00</xades:SigningTime><xades:SigningCertificate><xades:Cert><xades:CertDigest><ds:DigestMethod Algorithm="http://www.w3.org/2001/04/xmlenc#sha256" /><ds:DigestValue>14bvYbs9ga8cyHFXJ8Agpb48KJ+GT2OlljZBCKYclXw=</ds:DigestValue></xades:CertDigest><xades:IssuerSerial><ds:X509IssuerName>C=GT, O=SAT DEV, CN=CA</ds:X509IssuerName><ds:X509SerialNumber>7928221402283746626</ds:X509SerialNumber></xades:IssuerSerial></xades:Cert></xades:SigningCertificate></xades:SignedSignatureProperties><xades:SignedDataObjectProperties><xades:DataObjectFormat ObjectReference="#Reference-e0671322-0f3c-45fe-b91e-aa4a39a01727"><xades:MimeType>text/xml</xades:MimeType><xades:Encoding>UTF-8</xades:Encoding></xades:DataObjectFormat></xades:SignedDataObjectProperties></xades:SignedProperties></xades:QualifyingProperties></ds:Object></ds:Signature><ds:Signature xmlns:ds="http://www.w3.org/2000/09/xmldsig#" Id="Signature-54f0605a-8bbb-4ab4-ab89-a63cc35a29f2"><ds:SignedInfo><ds:CanonicalizationMethod Algorithm="http://www.w3.org/TR/2001/REC-xml-c14n-20010315" /><ds:SignatureMethod Algorithm="http://www.w3.org/2001/04/xmldsig-more#rsa-sha256" /><ds:Reference Id="Reference-f2bd6693-995e-4e97-9531-5a65edec4a41" URI="#DatosCertificados"><ds:Transforms><ds:Transform Algorithm="http://www.w3.org/TR/2001/REC-xml-c14n-20010315" /></ds:Transforms><ds:DigestMethod Algorithm="http://www.w3.org/2001/04/xmlenc#sha256" /><ds:DigestValue>wx/qZZCijmyAYdZtNqhFWSE3KuxEy1hj8dspXlPUT9Y=</ds:DigestValue></ds:Reference><ds:Reference Id="ReferenceKeyInfo-Signature-54f0605a-8bbb-4ab4-ab89-a63cc35a29f2" URI="#KeyInfoId-Signature-54f0605a-8bbb-4ab4-ab89-a63cc35a29f2"><ds:DigestMethod Algorithm="http://www.w3.org/2001/04/xmlenc#sha256" /><ds:DigestValue>NG8Fjqa7eQVtGkAE3Iuc+EmnzfDCAT+w4gISS5jWtFI=</ds:DigestValue></ds:Reference><ds:Reference Type="http://uri.etsi.org/01903#SignedProperties" URI="#SignedProperties-Signature-54f0605a-8bbb-4ab4-ab89-a63cc35a29f2"><ds:DigestMethod Algorithm="http://www.w3.org/2001/04/xmlenc#sha256" /><ds:DigestValue>ysesbmgX2wj1VwDGnNyH+6bDWp1MUyimgBqjqs4gHB0=</ds:DigestValue></ds:Reference></ds:SignedInfo><ds:SignatureValue Id="SignatureValue-54f0605a-8bbb-4ab4-ab89-a63cc35a29f2">an56akJ0Q3/rEgBlC9gebJ7ca6MkRAoBLpFqeOiC/8dgBYLg2X9maXcohZnjYRvibVPtTZ4YtBuEAV6L7lTlmeVVfyKXgSxsrkxJlQxyiVOeGEHi3sz37MLC3G/7H/Y4FlYNihuAQOgBSJRaC7rUBIH+EoRgEK68KWqdNKD4uo2pBfVaLlTKVvhJkAwUvunu74rXRT/+w82Dznf/dWmqRBXKjcJH6ODV5cLclmthENNx0STiEBBMguRvzFny9KmpjOLUW/ExHjvZvgCId8Ti3u7ppBFH/FfnvV+B//zLvQRiXAzLy8WNN/M5RrNOcWTjhAJyWEHpT6S+jxm5as3ChA==</ds:SignatureValue><ds:KeyInfo Id="KeyInfoId-Signature-54f0605a-8bbb-4ab4-ab89-a63cc35a29f2"><ds:X509Data><ds:X509Certificate>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</ds:X509Certificate></ds:X509Data><ds:KeyValue><ds:RSAKeyValue><ds:Modulus>vwaqlct+/i+KvgVomXsVLGH4qo+03eJRY9C8R3ul7iOQ9+AXu26LhpkXwyZvUnKcUJywPjtaTLiyr/GLVHNm4lSATrwmZnF6I7OO75WhJqYXACFyQ9jYO08MIYc2WohLN2pMepa8sMaIedpJGXELiXvllHSS6wa2jVktX7YD8pCdKSHvBXXFdR9huYImr3VJ1LHh4T/LciuJJ7y50SSzdyLjvbpuhEj+fAxw64dKZK0SgDGOjKmDO7YTUJfAf+nEoRw8dnLjlS/5GeJTefYBK8YLqF5bYMYKill1FgVF3AY2o5bRktHtYxiuN4849BKLxZnq3w5UYogndgq34JZCNQ==</ds:Modulus><ds:Exponent>Aw==</ds:Exponent></ds:RSAKeyValue></ds:KeyValue></ds:KeyInfo><ds:Object Id="XadesObjectId-37015f5d-b7ac-4e52-9c61-bbd406a58bdf"><xades:QualifyingProperties xmlns:xades="http://uri.etsi.org/01903/v1.3.2#" Id="QualifyingProperties-657c282f-7863-4cdb-971e-a2441c0900a0" Target="#Signature-54f0605a-8bbb-4ab4-ab89-a63cc35a29f2"><xades:SignedProperties Id="SignedProperties-Signature-54f0605a-8bbb-4ab4-ab89-a63cc35a29f2"><xades:SignedSignatureProperties><xades:SigningTime>2021-12-24T15:57:34-06:00</xades:SigningTime><xades:SigningCertificate><xades:Cert><xades:CertDigest><ds:DigestMethod Algorithm="http://www.w3.org/2001/04/xmlenc#sha256" /><ds:DigestValue>p7/DhaACMDY+ikMN8JeAkkX/Jf4iYVeC98/+6F+dHC0=</ds:DigestValue></xades:CertDigest><xades:IssuerSerial><ds:X509IssuerName>CN=AC SUB CERTICAMARA, O=CERTICAMARA S.A, OU=NIT 830084433-7, C=CO, S=DISTRITO CAPITAL, L=BOGOTA, STREET=www.certicamara.com</ds:X509IssuerName><ds:X509SerialNumber>4027847649684118354734956758906464042</ds:X509SerialNumber></xades:IssuerSerial></xades:Cert></xades:SigningCertificate></xades:SignedSignatureProperties><xades:SignedDataObjectProperties><xades:DataObjectFormat ObjectReference="#Reference-f2bd6693-995e-4e97-9531-5a65edec4a41"><xades:MimeType>text/xml</xades:MimeType><xades:Encoding>UTF-8</xades:Encoding></xades:DataObjectFormat></xades:SignedDataObjectProperties></xades:SignedProperties></xades:QualifyingProperties></ds:Object></ds:Signature></dte:GTDocumento>';*/
//            $documentdecodify = simplexml_load_string($xmlsdocument);
//            $documentdecodify = json_decode(json_encode($documentdecodify), TRUE);

            return $documentdecodify;

        } catch (SoapFault $e) {
            return $e->getMessage();
        }
    }

    /**
     * @throws \Exception
     */
    public function certificateDTE(Request $dataRequest)
    {
        try {

            if ($dataRequest->invoiceData->nit !== "CF") {
                $queryNIT = $this->verifynit($dataRequest->invoiceData->nit);
                $resultNIT = json_decode($queryNIT->content());

                if ($resultNIT->nit->Result === true) {
                    $dataRequest->invoiceData->name = $resultNIT->nit->nombre;
                } else {
                    if (isset($resultNIT->nit)) {
                        throw new \Exception($resultNIT->nit->error);
                    }
                    throw new \Exception("Error en el NIT, porfavor verifique.");
                }
            }

//            self::setWSDL('https://app.corposistemasgt.com/webservicefronttest/factwsfront.asmx?wsdl'); //Servicio de Pruebas
            self::setWSDL('https://app.corposistemasgt.com/webservicefront/factwsfront.asmx?wsdl');
            $service = InstanceSoapClient::init();

//            return $dataRequest->sale_details[0]["presentation"];
            $responseXMLGenerate = $this->generateXMLtoCertificate($dataRequest->invoiceData, $dataRequest->sale_details, $dataRequest->totalSale, $dataRequest->storeData, $dataRequest->storeId, $dataRequest->sellerId);
            $xmlGenerate = $responseXMLGenerate->xmlDocument;

            $xmlPOST = base64_encode($xmlGenerate);

            $query = $service->RequestTransaction([
                'Requestor' => getenv("FEL_REQUESTOR"),
                'Transaction' => 'SYSTEM_REQUEST',
                'Country' => 'GT',
                'Entity' => getenv("FEL_NIT"),
                'User' => getenv("FEL_REQUESTOR"),
                'UserName' => getenv("FEL_USER"),
                'Data1' => 'POST_DOCUMENT_SAT',
                'Data2' => $xmlPOST,
                'Data3' => '']);

            $query = get_object_vars($query->RequestTransactionResult);

            // Save data to DB
            $dataSaveInvoiceGenerated = (object) ['invoiceCertificated' => (object)["serie" => $query["Response"]->Identifier->Serial, "number" => $query["Response"]->Identifier->Batch, "certification" => $query["Response"]->Identifier->DocumentGUID, "date" => now(config('app.timezone'))->format('Y-m-d'),"dateCertification" => $query["Response"]->TimeStamp], 'dataGeneratedInvoice' => $responseXMLGenerate->dataRegisterInvoice];
            $this->saveInvoiceGenerated($dataSaveInvoiceGenerated);

        //    return $query["Response"]->Identifier;
            return array(["serialDTE" => $query["Response"]->Identifier->Serial, "numberDTE" => $query["Response"]->Identifier->Batch, "certificationDTE" => $query["Response"]->Identifier->DocumentGUID, "datetimeCertificationDTE" => $query["Response"]->TimeStamp]);
        } catch (SoapFault $e) {
            return $e->getMessage();
        }
    }

    private function saveInvoiceGenerated(object $data)
    {
        try {
            FelInvoices::create([
                'storeId' => $data->dataGeneratedInvoice->storeId,
                'sellerId' => $data->dataGeneratedInvoice->sellerId,
                'invoiceCertificated' => json_encode($data->invoiceCertificated),
                'invoiceDataClient' => json_encode($data->dataGeneratedInvoice->ClientData),
                'invoiceDataItems' => json_encode($data->dataGeneratedInvoice->DataItems),
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function generateXMLtoCertificate($nitClient, $items, $totalSale, $storeData, $storeId = null, $sellerId = null): object
    {
            //Search in DB dataFEL, with storeID from User Seller
        if (isset($storeData) && $storeData !== null && $storeData !== '' && $storeData !== []) {
            $queryStoreDataFEL = $storeData;
            $storeFEL = $queryStoreDataFEL;
            // $storeFEL = json_decode($queryStoreDataFEL);
        } else {
            $queryStoreDataFEL = Stores::select('stores.dataFEL', 'stores.id')->join('sellers', 'stores.storeID', 'sellers.store_id')->where('sellers.user_id', \Auth::id())->first();
            $storeId = $queryStoreDataFEL->id;
            $storeFEL = json_decode($queryStoreDataFEL->dataFEL);
        }
        $nitClient->address = ($nitClient->address === NULL || $nitClient->address === "") ? "Ciudad" : $nitClient->address;
        $bigTotal = 0;

        $xmlHead = '<?xml version="1.0" encoding="utf-8"?>
        <dte:GTDocumento xmlns:ds="http://www.w3.org/2000/09/xmldsig#"
        xmlns:cfc="http://www.sat.gob.gt/dte/fel/CompCambiaria/0.1.0"
        xmlns:cno="http://www.sat.gob.gt/face2/ComplementoReferenciaNota/0.1.0"
        xmlns:cex="http://www.sat.gob.gt/face2/ComplementoExportaciones/0.1.0"
        xmlns:cfe="http://www.sat.gob.gt/face2/ComplementoFacturaEspecial/0.1.0"
        xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" Version="0.1"
        xmlns:dte="http://www.sat.gob.gt/dte/fel/0.2.0">';

        $xmlBody = '<dte:SAT ClaseDocumento="dte">';

        $xmlDTE = '<dte:DTE ID="DatosCertificados">';

        $xmlEmissionData = '<dte:DatosEmision ID="DatosEmision">';

    //  FechaHoraEmision="'.now(config('app.timezone'))->format('Y-m-d\TH:i:s').'";
        $xmlGeneralData = '<dte:DatosGenerales Tipo="FACT" FechaHoraEmision="'.now(config('app.timezone'))->format('Y-m-d\TH:i:s').'" CodigoMoneda="GTQ"/>';

        $xmlIssuer = '<dte:Emisor NITEmisor="'.getenv("FEL_NIT").'" NombreEmisor="'.getenv("FEL_NAME_ISSUER").'"
                        CodigoEstablecimiento="'.$storeFEL->storeCode.'" NombreComercial="'.$storeFEL->nameStore.'" AfiliacionIVA="GEN">
                        <dte:DireccionEmisor>
                            <dte:Direccion>'.$storeFEL->locationStore->direccion.'</dte:Direccion>
                            <dte:CodigoPostal>16001</dte:CodigoPostal>
                            <dte:Municipio>'.$storeFEL->locationStore->municipio.'</dte:Municipio>
                            <dte:Departamento>'.$storeFEL->locationStore->departamento.'</dte:Departamento>
                            <dte:Pais>GT</dte:Pais>
                        </dte:DireccionEmisor>
                    </dte:Emisor>';

        $xmlReceptor = '<dte:Receptor IDReceptor="'.$nitClient->nit.'" NombreReceptor="'.$nitClient->name.'">';

        $xmlReceptorAddress = '<dte:DireccionReceptor>
                                <dte:Direccion>'.$nitClient->address.'</dte:Direccion>
                                <dte:CodigoPostal>0</dte:CodigoPostal>
                                <dte:Municipio>.</dte:Municipio>
                                <dte:Departamento>.</dte:Departamento>
                                <dte:Pais>GT</dte:Pais>
                            </dte:DireccionReceptor>';

        $xmlReceptorCLS = '</dte:Receptor>';

        $xmlPhrase = '<dte:Frases>
                        <dte:Frase TipoFrase="1" CodigoEscenario="2"/>
                        <dte:Frase TipoFrase="4" CodigoEscenario="9"/>
                    </dte:Frases>';

        $xmlItemsData = '<dte:Items>';

        $xmlItem = '';
        $totalIVA = 0;

        $itemsInvoicePrint = array();

        foreach ($items as $key => $item) {
            if (isset($item["presentation"]["price"])) {
                $priceUnity = round($item["presentation"]["price"]/$item["presentation"]["quantity"], 6);
            } else {
                $priceUnity = round($item['priceSale'], 6);
            }
            $itemTotal = round($item["unit_quantity"] * $priceUnity, 6);

            $IVA = 0; // TOTAL IVA SI ES GENERICO
            $code_FEL_IVA = 2; // CODIGO DE IVA SEGUN FEL SAT
            $montoGravable = $itemTotal;

            if ($item["iva"] == TRUE) {
                $montoGravable = round($montoGravable/1.12, 6); // CALCULO DEL TOTAL SIN IVA DEL ITEM redondeado a 6 decimales
                $IVA = round($montoGravable * (12/100), 6); // CALCULO DEL IVA DEL ITEM -> IVA GENERAL 12% redondeado a 6 decimales
                $code_FEL_IVA = 1;
            }

//            $item["assetOrService"] Agregar columna para identificar
            $xmlItem .= '<dte:Item NumeroLinea="'. $key+1 .'" BienOServicio="B">
                            <dte:Cantidad>'.$item["unit_quantity"].'</dte:Cantidad>
                            <dte:UnidadMedida>UNI</dte:UnidadMedida>
                            <dte:Descripcion>'.$item["name"].'</dte:Descripcion>
                            <dte:PrecioUnitario>'.$priceUnity.'</dte:PrecioUnitario>
                            <dte:Precio>'.$itemTotal.'</dte:Precio>
                            <dte:Descuento>0</dte:Descuento>
                            <dte:Impuestos>
                                <dte:Impuesto>
                                    <dte:NombreCorto>IVA</dte:NombreCorto>
                                    <dte:CodigoUnidadGravable>'.$code_FEL_IVA.'</dte:CodigoUnidadGravable>
                                    <dte:MontoGravable>'.$montoGravable.'</dte:MontoGravable>
                                    <dte:MontoImpuesto>'.$IVA.'</dte:MontoImpuesto>
                                </dte:Impuesto>
                            </dte:Impuestos>
                            <dte:Total>'.$itemTotal.'</dte:Total>
                        </dte:Item>';

            $totalIVA += $IVA;
            $bigTotal += $itemTotal;

            $itemsInvoicePrint[] = ['itemID' => $item["itemID"], 'nameItem' => $item["name"], 'quantityItem' => $item["unit_quantity"], 'priceItemSale' => $priceUnity, 'priceItemPurchase' => 0, 'itemCountable' => $code_FEL_IVA, 'totalWithoutIVA' => $montoGravable, 'totalIVA' => $IVA, 'total' => $itemTotal];
        }


        $xmlItemsDataCLS = '</dte:Items>';

        $xmlTotals = '<dte:Totales>
                        <dte:TotalImpuestos>
                            <dte:TotalImpuesto NombreCorto="IVA" TotalMontoImpuesto="'.round($totalIVA, 6).'"/>
                        </dte:TotalImpuestos>
                        <dte:GranTotal>'.$bigTotal.'</dte:GranTotal>
                    </dte:Totales>';

        $xmlEmissionDataCLS = '</dte:DatosEmision>';

        $xmlDTECLS = '</dte:DTE>';

        $xmlBodyCLS = '</dte:SAT>';

        $xmlHeadCLS = '</dte:GTDocumento>';

        $xml = $xmlHead.$xmlBody.$xmlDTE.$xmlEmissionData.$xmlGeneralData.$xmlIssuer.$xmlReceptor.$xmlReceptorAddress.$xmlReceptorCLS.$xmlPhrase.$xmlItemsData.$xmlItem.$xmlItemsDataCLS.$xmlTotals.$xmlEmissionDataCLS.$xmlDTECLS.$xmlBodyCLS.$xmlHeadCLS;

        $dataRegisterInvoice = (object)['storeId' => $storeId, 'sellerId' => $sellerId, 'BigTotal' => $bigTotal, 'TaxesTotal' => round($totalIVA, 2), 'ClientData' => $nitClient, 'DataItems' => $itemsInvoicePrint];

        return $resp = (object) ['xmlDocument' => $xml, 'dataRegisterInvoice' => $dataRegisterInvoice];
    }

    public function voidDTE()
    {
        try {
            self::setWSDL("https://app.corposistemasgt.com/webservicefronttest/factwsfront.asmx?wsdl");
            $service = InstanceSoapClient::init();

            $xmlGenerate = $this->generateXMLtoVoid('2022-02-04T21:22:43', '42412692', 'Prueba Anulacion', 'E6ED3AFB-E5F6-4FA6-B3A1-1C9C57CE1AF7');
            $xmlVOID = base64_encode($xmlGenerate);

            $query = $service->RequestTransaction([
                'Requestor' => '8A454E3F-CEA1-41D8-A13A-A748A4891BBF',
                'Transaction' => 'SYSTEM_REQUEST',
                'Country' => 'GT',
                'Entity' => '800000001026',
                'User' => '8A454E3F-CEA1-41D8-A13A-A748A4891BBF',
                'UserName' => 'ADMINISTRADOR',
                'Data1' => 'VOID_DOCUMENT',
                'Data2' => $xmlVOID,
                'Data3' => '']);



            return $query;

        } catch (SoapFault $e) {
            return $e->getMessage();
        }
    }

    public function generateXMLtoVoid($dateDocument, $nitClient, $note, $documentID)
    {
        $xml = '<dte:GTAnulacionDocumento
                    xmlns:dte="http://www.sat.gob.gt/dte/fel/0.1.0"
                    xmlns:ds="http://www.w3.org/2000/09/xmldsig#"
                    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
                    Version="0.1"
                    xsi:schemaLocation="http://www.sat.gob.gt/dte/fel/0.1.0 GT_AnulacionDocumento-0.1.0.xsd">
                <dte:SAT>
                    <dte:AnulacionDTE ID="DatosCertificados">
                        <dte:DatosGenerales FechaEmisionDocumentoAnular="'.$dateDocument.'"
                                            FechaHoraAnulacion="'.now(config('app.timezone'))->format('Y-m-d\TH:i:s').'"
                                            ID="DatosAnulacion" IDReceptor="'.$nitClient.'"
                                            MotivoAnulacion="'.$note.'"
                                            NITEmisor="'.getenv("FEL_NIT").'" NumeroDocumentoAAnular="'.$documentID.'"/>
                    </dte:AnulacionDTE>
                </dte:SAT>
                </dte:GTAnulacionDocumento>';

        return $xml;
    }
}
