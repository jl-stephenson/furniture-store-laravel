<?php

namespace App\Services;

class CurrencyCalculationService
{
    public const GBP = 'gbp';
    public const USD = 'usd';
    public const EUR = 'eur';
    public const YEN = 'yen';

    public const UNITS = [
        CurrencyCalculationService::GBP => 1,
        CurrencyCalculationService::USD => 1.19,
        CurrencyCalculationService::EUR => 1.16,
        CurrencyCalculationService::YEN => 162.16,
    ];

    public const SYMBOLS = [
        CurrencyCalculationService::GBP => '£',
        CurrencyCalculationService::USD => '$',
        CurrencyCalculationService::EUR => '€',
        CurrencyCalculationService::YEN => '¥',
    ];

    public static function convertCurrency(array $prices, string $currency): array
    {
            foreach($prices as $price) {
                if ($price <= 0) {
                    throw new Exception('Dimension must be greater than 0');
                }

                $convertedPrices[] = CurrencyCalculationService::SYMBOLS[$currency] . number_format($price * CurrencyCalculationService::UNITS[$currency], 2);

            }
        return $convertedPrices;
    }
}
