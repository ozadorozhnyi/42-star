<div>
    <span>Tariff: <strong><?= $current_subscription['name']?></strong></span><br>
    <span>Users: <b><?= $current_subscription['total_users']?></b></span><br>
    <span>Total: <b><?= $current_subscription['total_price']?></b>&euro;</span><br>
    <span>Period: <b><?= $current_subscription['payment_frequency']?></b></span><br>
    <span>Next Payment: <strong><?= $current_subscription['next_payment_date']?></strong></span><br>
</div>