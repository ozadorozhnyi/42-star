<?php

declare(strict_types=1);

class SubscriptionController extends Controller
{
    public function __construct($model)
    {
        parent::__construct($model);
    }

    public function change()
    {
        // @todo: write a separate class with static methods & use filter_var inside.
        // https://www.php.net/manual/ru/function.filter-input-array.php
        $validated = [
            'current_subscription_id' => (int)$_POST['current_subscription_id'],
            'tariff_id' => (int)$_POST['tariff_id'],
            'total_users' => (int)$_POST['total_users'],
            'payment_frequency' => in_array($_POST['payment_frequency'], PAYMENT_FREQUENCY_OPTIONS)? $_POST['payment_frequency']:'monthly',
        ];

        $this->model->createNextSubscription(
            $validated['current_subscription_id'],
            $validated['tariff_id'],
            $validated['total_users'],
            $validated['payment_frequency'],
        );

        header('Location: /', true);
        exit;
    }
}