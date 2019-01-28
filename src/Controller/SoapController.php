<?php

namespace App\Controller;


use App\Model\WsdlGenerator;
use App\Service\SoapService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Zend\Soap\Server;
use Zend\Soap\Server\DocumentLiteralWrapper;

class SoapController extends AbstractController {

    /**
     * @Route("/wsdl", methods={"GET"}, name="app_wsdl")
     */
    public function wsdl(WsdlGenerator $wsdlGenerator) {
        $wsdl = $wsdlGenerator->generate(SoapService::class);
        $rawWsdl = $wsdl->toXML();

        return new Response($wsdl->toXML(), Response::HTTP_OK, [
            'Content-type' => 'text/xml; charset=utf-8',
            'Content-length' => mb_strlen($rawWsdl)
        ]);
    }

    /**
     * @Route("/", methods={"POST"}, name="app_soap_service")
     */
    public function service(SoapService $soapService) {
        $server = new Server('http://soap-task-server' . $this->generateUrl('app_wsdl'), [
            'typemap' => [
                [
                    'type_name' => 'dateTime',
                    'type_ns' => 'http://www.w3.org/2001/XMLSchema',
                    'from_xml' => 'App\Model\Soap\DateTimeMapper::fromXML',
                    'to_xml' => 'App\Model\Soap\DateTimeMapper::toXML'
                ],
            ],
            'options' => [
                'cache_wsdl' => WSDL_CACHE_DISK
            ]
        ]);
        $server->setObject(new DocumentLiteralWrapper($soapService));
        $result = $server->handle();
        if ($result instanceof \SoapFault) {
            return new Response($result, $result->getCode());
        }

        return new Response($result);
    }

    /**
     * @Route("/", methods={"GET"}, name="app_readme")
     */
    public function readme() {
        return $this->render('soap/index.html.twig');
    }

}