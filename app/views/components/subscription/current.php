<h3>Current Subscription</h3>
<div>
    <?php
        $discount_label = ($current_subscription['payment_frequency'] === PAYMENT_FREQUENCY_ANNUALLY)
            ? "&nbsp;(-". ($current_subscription['discount_rate'] * 100) . "%)"
            : '';
    ?>
    <span>Tariff: <strong><?= $current_subscription['name']?></strong> (<?= $current_subscription['price_per_month'] ?>&euro;/per user)</span><br>
    <span>Users: <b><?= $current_subscription['total_users']?></b></span><br>
    <span>Total: <b><?= round($current_subscription['total_price']/100,2)?></b>&euro;<?=$discount_label?></span><br>
    <span>Period: <b><?= $current_subscription['payment_frequency']?></b></span><br>
    <span>Next Payment: <strong><?= $current_subscription['next_payment_date']?></strong></span><br>
</div>