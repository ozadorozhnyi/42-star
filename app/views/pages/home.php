<h3>Current Subscription</h3>
<?php if ($current_subscription): ?>
    <?php include_once __DIR__.'/../components/subscription/current.php'; ?>
    <hr>
    <?php include_once __DIR__.'/../components/subscription/change.php'; ?>
<?php else: ?>
    <p>There is no subscription selected yet.</p>
<?php endif ?>