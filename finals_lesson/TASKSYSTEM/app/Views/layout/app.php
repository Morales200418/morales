<?php $config = require __DIR__ . '/../../Config/config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? '' ?></title>
    <link rel="stylesheet" href="<?= rtrim($config['app_url'], '/')?> /assets/css/bootstrap.min.css">
</head>
<body>S
    <?php require $contentView; ?>
</body>
</html>
<script src="<?= rtrim($config['app_url'],'/')?> /assets/js/bootstrap.min.js"></script>
hie-iyrb-pmy