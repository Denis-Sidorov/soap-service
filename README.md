SOAP SERVER
===========

Based on Zend soap component and Symfony 4.

Have wsdl auto generation.

Style: document/literal wrapped

Installation
------------

`docker-compose build && docker-compose up -d`

Configs
-------

_.env:_

* APP_ENV - environment dev / prod
* WSDL_URI - URI for WSDL
* INSTALL_XDEBUG - argument for docker build

Endpoints
---------

* **POST /** - Soap service
    * getTaxiInfo - Return information about taxi. Randomly spawn errors and incorrect data.
* **GET /wsdl** - Wsdl generator 

---

Example
-------

### Request

    <soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:loc="http://localhost:8099">
       <soapenv:Header/>
       <soapenv:Body>
          <loc:getTaxiInfo>
             <regNum>ЕМ333777</regNum>
          </loc:getTaxiInfo>
       </soapenv:Body>
    </soapenv:Envelope>
    
### Response

    <SOAP-ENV:Envelope xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:ns1="http://localhost:8099">
       <SOAP-ENV:Body>
          <ns1:getTaxiInfoResponse>
             <getTaxiInfoResult>
                <licenseNum>02651</licenseNum>
                <licenseDate>2011-08-08T00:00:00+00:00</licenseDate>
                <name>ООО "НЖТ-ВОСТОК"</name>
                <ogrnNum>1107746402246</ogrnNum>
                <ogrnDate>2010-05-17T00:00:00+00:00</ogrnDate>
                <brand>FORD</brand>
                <model>FOCUS</model>
                <regNum>ЕМ333777</regNum>
                <year>2011</year>
                <blankNum>002695</blankNum>
                <info xsi:nil="true"/>
             </getTaxiInfoResult>
          </ns1:getTaxiInfoResponse>
       </SOAP-ENV:Body>
    </SOAP-ENV:Envelope>

