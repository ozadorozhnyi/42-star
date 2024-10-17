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
        $validated = FormValidator::subscription();

        if (null === $validated || in_array(false, $validated, true)) {
            $_SESSION['error_message'] = 'Invalid input data!';
        } else {
            $this->model->createNextSubscription(
                $validated['current_subscription_id'],
                $validated['tariff_id'],
                $validated['total_users'],
                $validated['payment_frequency'],
            );
        }

        header('Location: /', true);
        exit;
    }
}