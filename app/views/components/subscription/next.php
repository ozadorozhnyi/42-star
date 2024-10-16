<h3>→&nbsp;Your Next Subscription</h3>
<div>
    <?php
        $discount_label = ($next_subscription['payment_frequency'] === PAYMENT_FREQUENCY_ANNUALLY)
            ? "&nbsp;(-". ($next_subscription['discount_rate'] * 100) . "%)"
            : '';
    ?>
    <span>Tariff: <strong><?= $next_subscription['name']?></strong> (<?= $next_subscription['price_per_month'] ?>&euro;/per user)</span><br>
    <span>Users: <b><?= $next_subscription['total_users']?></b></span><br>
    <span>Total: <b><?= round($next_subscription['total_price']/100, 2)?></b>&euro;<?=$discount_label?></span><br>
    <span>Period: <b><?= $next_subscription['payment_frequency']?></b></span><br>
    <span>Next Payment: <strong><?= $next_subscription['next_payment_date']?></strong></span><br>
</div>