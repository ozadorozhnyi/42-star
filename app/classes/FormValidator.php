<?php

class FormValidator
{
    /**
     * Validate change subscription form request.
     *
     * @return array|false|null
     */
    public static function subscription(): array|false|null
    {
        $args = array(
            'current_subscription_id' => array(
                'filter' => FILTER_VALIDATE_INT,
                'flags'  => FILTER_REQUIRE_SCALAR,
            ),
            'tariff_id' => array(
                'filter' => FILTER_VALIDATE_INT,
                'flags'  => FILTER_REQUIRE_SCALAR,
            ),
            'total_users' => array(
                'filter' => FILTER_VALIDATE_INT,
                'flags'  => FILTER_REQUIRE_SCALAR,
                'options' => array('min_range' => 1, 'max_range' => 10)
            ),
            'payment_frequency' => array(
                'filter' => FILTER_CALLBACK,
                'options' => function($value) {
                    $allowed_values = [PAYMENT_FREQUENCY_MONTHLY, PAYMENT_FREQUENCY_ANNUALLY];
                    return in_array($value, $allowed_values) ? $value : null;
                }
            )
        );

        return filter_input_array(INPUT_POST, $args);
    }
}