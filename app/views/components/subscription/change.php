<div>
    <h3>Change Plan</h3>
    <form method="post" action="/?action=change" enctype="application/x-www-form-urlencoded">
        <input type="hidden" name="current_subscription_id" value="<?= $current_subscription['id'] ?>">
        <div>
            <label for="tariff">Tariff</label>
            <select name="tariff_id" id="tariff">
                <?php foreach ($tariffs as $tariff): ?>
                    <option value="<?= $tariff['id'] ?>">
                        <?= "{$tariff['name']}&nbsp;{$tariff['price_per_month']}&euro;" ?>
                    </option>
                <?php endforeach; ?>
                }
            </select>
        </div>
        <div>
            <label for="total_users">Users</label>
            <select name="total_users" id="total_users">
                <?php for ($i = 1; $i <= 10; $i++): ?>
                    <option value="<?=$i?>"><?=$i?></option>
                <?php endfor; ?>
            </select>
        </div>
        <div>
            <label for="payment_frequency">Payment Frequency</label>
            <select name="payment_frequency" id="payment_frequency">
                <option value="<?= PAYMENT_FREQUENCY_MONTHLY ?>" selected>
                    <?= PAYMENT_FREQUENCY_MONTHLY ?>
                </option>
                <option value="<?= PAYMENT_FREQUENCY_ANNUALLY ?>">
                    <?= PAYMENT_FREQUENCY_ANNUALLY ?>
                </option>
            </select>
        </div>
        <div>
            <input type="submit" name="btnChange" value="Change Tariff">
        </div>
    </form>
</div>