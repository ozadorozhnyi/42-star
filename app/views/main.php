<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="/css/styles.css">
        <title>Plan42</title>
    </head>
    <body>
        <?php if (isset($_SESSION['error_message'])): ?>
            <p class="error_message">
                <?= $_SESSION['error_message'] ?>
                <?php unset($_SESSION['error_message']) ?>
            </p>
        <?php endif ?>
        <?php
            $page_path = __DIR__ . '/pages/' . $page . '.php';
            if (is_readable($page_path)) {
                require_once $page_path;
            } else {
                echo "Page `{$page}` not found!";
            }
        ?>
    </body>
</html>