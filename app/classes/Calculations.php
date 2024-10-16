<?php

declare(strict_types=1);

class Calculations
{
    /**
     * Calculate subscription total price.
     * @todo: Replace with `Strategy` pattern in future.
     *
     * @param array $tariff
     * @param int $total_users
     * @param string $payment_frequency_type
     *
     * @return int
     */
    public static function calculateTotalPrice(
        array  $tariff,
        int    $total_users,
        string $payment_frequency_type = PAYMENT_FREQUENCY_MONTHLY,
    ): int
    {
        $monthly_cost = $tariff['price_per_month'] * $total_users;

        if ($payment_frequency_type === PAYMENT_FREQUENCY_MONTHLY) {
            return $monthly_cost * 100;
        }

        $annual_cost = $monthly_cost * 12;
        $discount_rate = self::calculateDiscountRate($payment_frequency_type);

        return (int)($annual_cost * (1 - $discount_rate)) * 100;
    }

    /**
     * Calculate next payment date.
     *
     * @param string $payment_date
     * @param string $payment_frequency
     * @return string
     * @throws Exception
     */
    public static function calculateNextPaymentDate(
        string $payment_date,
        string $payment_frequency
    ): string
    {
        $months_to_add = $payment_frequency === PAYMENT_FREQUENCY_MONTHLY ? 1 : 12;

        return (new DateTime($payment_date))
            ->modify("+{$months_to_add} months")
            ->modify("+1 day")
            ->format('Y-m-d');
    }

    /**
     * Calculate discount rate.
     *
     * @param string $payment_frequency
     * @return float
     */
    public static function calculateDiscountRate(string $payment_frequency): float
    {
        return $payment_frequency === PAYMENT_FREQUENCY_MONTHLY
            ? 0.00
            : ANNUALLY_DISCOUNT_RATE;
    }
}