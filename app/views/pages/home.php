<?php if ($current_subscription): ?>
    <div class="subscriptions">
        <span>
            <?php include_once __DIR__.'/../components/subscription/current.php'; ?>
        </span>
        <?php if ($next_subscription): ?>
            <span class="next-subscription">
                <?php include_once __DIR__.'/../components/subscription/next.php'; ?>
            </span>
        <?php endif; ?>
    </div>
    <hr>
    <?php include_once __DIR__.'/../components/subscription/change.php'; ?>
<?php else: ?>
    <p>There is no subscription selected yet.</p>
<?php endif ?>