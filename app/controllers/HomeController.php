<?php

declare(strict_types=1);

class HomeController extends Controller
{
    public function __construct($model)
    {
        parent::__construct($model);
    }

    public function index()
    {
        $tariffs = $this->model->getTariffs();
        $current_subscription = $this->model->getCurrentSubscription();
        $next_subscription = $this->model->getNextSubscription(
            $current_subscription['id']
        );

        $this->render('home', [
            'tariffs' => $tariffs,
            'current_subscription' => $current_subscription,
            'next_subscription' => $next_subscription,
        ]);
    }
}