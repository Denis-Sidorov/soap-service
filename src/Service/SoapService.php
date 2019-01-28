<?php

namespace App\Service;


use App\Model\TaxiInfo;
use App\Repository\TaxiRepository;

class SoapService {

    /**
     * @var TaxiRepository
     */
    private $taxiRepository;

    /**
     * SoapService constructor.
     * @param TaxiRepository $taxiRepository
     */
    public function __construct(TaxiRepository $taxiRepository) {
        $this->taxiRepository = $taxiRepository;
    }

    /**
     * @param string $regNum
     * @return App\Model\TaxiInfo
     * @throws \SoapFault
     */
    public function getTaxiInfo(string $regNum): TaxiInfo {
        try {
            $taxiInfo = $this->taxiRepository->getTaxiInfo($regNum);
        } catch (\Exception $e) {
            throw new \SoapFault("Server", "Internal error");
        }

        if (is_null($taxiInfo)) {
            throw new \SoapFault('Server', 'Invalid argument', 'getTaxiInfo', 'Car not found');
        }

        return $taxiInfo;
    }



}