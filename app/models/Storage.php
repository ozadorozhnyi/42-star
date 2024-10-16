<?php

declare(strict_types=1);

class Storage
{
    private PDO $pdo;

    public function __construct(string $dsn, string $username, string $password = '')
    {
        try {
            $this->pdo = new PDO($dsn, $username, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
        }
    }

    public function getSubscription(int $id): ?array
    {
        $sql = 'SELECT * FROM subscriptions WHERE id = :id';
        $sth = $this->pdo->prepare($sql);
        $sth->bindParam(':id', $id, PDO::PARAM_INT);
        $sth->execute();

        $subscription = $sth->fetch(PDO::FETCH_ASSOC);

        return $subscription ?: null;
    }

    public function getTariff(int $id): ?array
    {
        $sql = "SELECT * FROM tariffs WHERE id = :id";
        $sth = $this->pdo->prepare($sql);
        $sth->bindParam(':id', $id, PDO::PARAM_INT);
        $sth->execute();

        $tariff = $sth->fetch(PDO::FETCH_ASSOC);

        return $tariff ?: null;
    }

    public function createNextSubscription(
        int $current_subscription_id,
        int $tariff_id,
        int $total_users,
        string $payment_frequency,
    ): void
    {
        $tariff = $this->getTariff($tariff_id);
        $subscription = $this->getSubscription($current_subscription_id);

        $total_price = Calculations::calculateTotalPrice($tariff, $total_users, $payment_frequency);
        $next_payment_date = Calculations::calculateNextPaymentDate($subscription['next_payment_date'], $payment_frequency);
        $discount_rate = Calculations::calculateDiscountRate($payment_frequency);

        $this->insertSubscription(
            $current_subscription_id,
            $tariff_id,
            $total_users,
            $total_price,
            (string)$discount_rate,
            $payment_frequency,
            $next_payment_date
        );
    }

    public function getTariffs(): array
    {
        return $this->pdo->query(
            'SELECT * FROM `tariffs` ORDER BY `price_per_month` ASC;'
        )->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCurrentSubscription(): mixed
    {
        $sql = '
            SELECT
                t.name,
                s.id, s.total_users, s.total_price, s.payment_frequency, s.next_payment_date
            FROM `subscriptions` as s
            INNER JOIN tariffs as t ON s.tariff_id = t.id;
        ';

        $result = $this->pdo->query($sql, PDO::FETCH_ASSOC)->fetch();

        if (!$result) {
            return null;
        }

        return [
            'id' => $result['id'],
            'name' => $result['name'],
            'total_users' => $result['total_users'],
            'total_price' => $result['total_price'] / 100,
            'payment_frequency' => $result['payment_frequency'],
            'next_payment_date' => $result['next_payment_date'],
        ];
    }

    private function insertSubscription(
        int $parent_id,
        int $tariff_id,
        int $total_users,
        int $total_price,
        string $discount_rate,
        string $payment_frequency,
        string $next_payment_date
    ):void
    {
        $sql = '
            INSERT INTO `subscriptions` (`parent_id`, `tariff_id`, `total_users`, `total_price`, `discount_rate`, `payment_frequency`, `next_payment_date`)
            VALUES (:parent_id, :tariff_id, :total_users, :total_price, :discount_rate, :payment_frequency, :next_payment_date);
        ';

        $sth = $this->pdo->prepare($sql);

        $sth->bindParam('parent_id', $parent_id, PDO::PARAM_INT);
        $sth->bindParam('tariff_id', $tariff_id, PDO::PARAM_INT);
        $sth->bindParam('total_users', $total_users, PDO::PARAM_INT);
        $sth->bindParam('total_price', $total_price, PDO::PARAM_INT);
        $sth->bindParam('discount_rate', $discount_rate, PDO::PARAM_STR);
        $sth->bindParam('payment_frequency', $payment_frequency, PDO::PARAM_STR);
        $sth->bindParam('next_payment_date', $next_payment_date, PDO::PARAM_STR);

        $sth->execute();
    }
}