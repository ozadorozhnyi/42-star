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
        $current_subscription = $this->model->getCurrentSubscription();
        $tariffs = $this->model->getTariffs();

        $this->render('home', [
            'current_subscription' => $current_subscription,
            'tariffs' => $tariffs
        ]);
    }
}