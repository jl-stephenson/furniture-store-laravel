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

    public static function convertCurrency(float $price, string $currency): string
    {
                if ($price <= 0) {
                    throw new Exception('Price must be greater than 0');
                }

                $convertedPrice = CurrencyCalculationService::SYMBOLS[$currency] . number_format($price * CurrencyCalculationService::UNITS[$currency], 2);

        return $convertedPrice;
    }
}
