<?php
    use GamePlanner\Libraries\App;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="<?= App::url('media/css/main.css') ?>">
    <script src="<?= App::url('media/js/jquery-3.7.1.min.js') ?>"></script>
    <script defer src="<?= App::url('media/js/alpinejs-3.14.0.min.js') ?>"></script>
</head>
<body>
    <?= $this->block('block/nav', ['game' => $game, 'navActive' => $nav]) ?>
    <div class="content">
        <?= $this->section('content') ?>
    </div>
</body>
<script>
    <?= $this->scripts() ?>
</script>
</html>