<?php

namespace App\Model;


use App\Model\Zend\Soap\Wsdl;
use Zend\Soap\AutoDiscover;
use Zend\Soap\Wsdl\ComplexTypeStrategy\ArrayOfTypeComplex;

class WsdlGenerator {

    /** @var string  */
    private $uri;

    /**
     * WsdlGenerator constructor.
     * @param string $uri
     */
    public function __construct(string $uri) {
        $this->uri = $uri;
    }

    /**
     * @param string $class
     * @return \Zend\Soap\Wsdl
     */
    public function generate($class): \Zend\Soap\Wsdl {
        $autoDiscover = new AutoDiscover(new ArrayOfTypeComplex());
        $autoDiscover
            ->setClass($class)
            ->setUri($this->uri)
            ->setServiceName('TestTask')
            ->setBindingStyle(['style' => 'document'])
            ->setOperationBodyStyle(['use' => 'literal'])
            ->setWsdlClass(Wsdl::class);

        return $autoDiscover->generate();
    }

}