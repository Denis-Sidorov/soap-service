<?php

namespace App\Model\Soap;


class DateTimeMapper {

    /**
     * @param \DateTime $date
     * @return string
     */
    public static function toXml(\DateTime $date): string {
        return '<dateTime>' . $date->format('c') . '</dateTime>';
    }

    /**
     * @param string $date
     * @return \DateTime|null
     */
    public static function fromXml(string $date): ?\DateTime {
        try {
            return new \DateTime(strip_tags($date));
        } catch (\Exception $e) {
            return null;
        }

    }

}