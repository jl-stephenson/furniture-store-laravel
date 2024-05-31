<?php

namespace App\Services;

class MeasurementCalculationService
{
    public const MM = 'mm';
    public const CM = 'cm';
    public const IN = 'in';
    public const FT = 'ft';

    public const UNITS = [
        MeasurementCalculationService::MM => 1,
        MeasurementCalculationService::CM => 10,
        MeasurementCalculationService::IN => 25.4,
        MeasurementCalculationService::FT => 304.8,
    ];

    public static function convertUnits(array $dimensions, string $unitOfMeasurement): array
    {
        foreach ($dimensions as $dimension) {
            if ($dimension < 0) {
                throw new Exception('Dimension must be greater than 0');
            }

            if ($unitOfMeasurement === MeasurementCalculationService::MM) {
                $convertedDimensions[] = number_format($dimension / MeasurementCalculationService::UNITS[$unitOfMeasurement]) . $unitOfMeasurement;
            } else {
                $convertedDimensions[] = number_format($dimension / MeasurementCalculationService::UNITS[$unitOfMeasurement], 2) . $unitOfMeasurement;
            }
        }
        return $convertedDimensions;
    }
}
