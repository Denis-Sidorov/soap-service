<?php

namespace App\Repository;


use App\Model\TaxiInfo;

class TaxiRepository {

    const NORMAL_TAXI = 'normal';
    const UNKNOWN_TAXI = 'unknown';
    const ERROR_TAXI = 'error';
    const NO_FIELDS_TAXI = 'no_fields';

    /**
     * @param string $regNum
     * @return TaxiInfo|null
     * @throws \Exception
     */
    public function getTaxiInfo(string $regNum): ?TaxiInfo {
        if ($regNum !== 'ЕМ333777') {
            return null;
        }

        return $this->hydrate($this->getRandomTaxi());
    }

    /**
     * @return array
     * @throws \Exception
     */
    private function getRandomTaxi(): array {
        $code = mt_rand(0, 8);
        $errorCodes = [
            self::UNKNOWN_TAXI,
            self::ERROR_TAXI,
            self::NO_FIELDS_TAXI
        ];

        $type = array_key_exists($code, $errorCodes) ? $errorCodes[$code] : self::NORMAL_TAXI;
        if ($type === self::ERROR_TAXI) {
            throw new \Exception("Some error");
        }

        return $this->getTaxi($type);
    }

    /**
     * @param string $type
     * @return array
     * @throws \Exception
     */
    private function getTaxi($type = 'normal'): array {
        $taxi = [
            self::NORMAL_TAXI => [
                'licenseNum' => '02651',
                'licenseDate' => new \DateTime('2011-08-08T0:00:00'),
                'name' => 'ООО "НЖТ-ВОСТОК"',
                'ogrnNum' => 1107746402246,
                'ogrnDate' => new \DateTime('2010-05-17T0:00:00'),
                'brand' => 'FORD',
                'model' => 'FOCUS',
                'regNum' => 'ЕМ333777',
                'year' => 2011,
                'blankNum' => '002695',
                'info' => null,
            ],
            self::UNKNOWN_TAXI => [
                'licenseNum' => '45234',
                'licenseDate' => new \DateTime('2012-08-08T0:00:00'),
                'name' => 'ООО "НЖТ-СЕВЕР"',
                'ogrnNum' => 1207746402223,
                'ogrnDate' => new \DateTime('2013-05-17T0:00:00'),
                'brand' => 'FORD',
                'model' => 'LOTUS',
                'regNum' => 'ЕМ22278',
                'year' => 2010,
                'blankNum' => '002696',
                'info' => null,
            ],
            self::NO_FIELDS_TAXI => [
                'licenseDate' => new \DateTime('2011-08-08T0:00:00'),
                'name' => 'ООО "НЖТ-ВОСТОК"',
                'model' => 'FOCUS',
                'regNum' => 'ЕМ333777',
                'year' => 2011,
            ],
        ];

        return $taxi[$type];
    }

    /**
     * @param array $taxi
     * @return TaxiInfo
     */
    private function hydrate(array $taxi): TaxiInfo {
        $taxiInfo = new TaxiInfo();
        $taxiInfo->licenseNum = $taxi['licenseNum'];
        $taxiInfo->licenseDate = $taxi['licenseDate'];
        $taxiInfo->name = $taxi['name'];
        $taxiInfo->ogrnNum = $taxi['ogrnNum'];
        $taxiInfo->ogrnDate = $taxi['ogrnDate'];
        $taxiInfo->brand = $taxi['brand'];
        $taxiInfo->model = $taxi['model'];
        $taxiInfo->regNum = $taxi['regNum'];
        $taxiInfo->year = $taxi['year'];
        $taxiInfo->blankNum = $taxi['blankNum'];
        $taxiInfo->info = $taxi['info'];
        return $taxiInfo;
    }

}