<?php

namespace App\Model\Zend\Soap;


class Wsdl extends \Zend\Soap\Wsdl {

    /**
     * Returns an XSD Type for the given PHP type
     *
     * @param  string $type PHP Type to get the XSD type for
     * @return string
     */
    public function getType($type) {
        if (strtolower($this->trimNamespace($type)) === 'datetime') {
            return self::XSD_NS . ':dateTime';
        }

        return parent::getType($type);
    }

    /**
     * @param string $type
     * @return string
     */
    private function trimNamespace($type) {
        $nameParts = explode('\\', $type);
        return array_pop($nameParts);
    }

}