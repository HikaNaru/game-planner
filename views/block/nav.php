<?php
    use GamePlanner\Libraries\App;
    use GamePlanner\Libraries\Data;

    $navs = Data::getNav();
?>

<div class="navigation">
<?php foreach ($navs as $nav): ?>
    <div class="nav">
        <div class="label">
            <label><?= App::get($nav, 'label') ?></label>
            <span class="material-symbols">arrow_right</span>
        </div>
<?php if (App::get($nav, 'subnav', [])): ?>
        <div class="subnav">
<?php foreach (App::get($nav, 'subnav', []) as $sub): ?>
            <div><?= App::get($sub, 'label') ?></div>
<?php endforeach ?>
        </div>
<?php endif ?>
    </div>
<?php endforeach ?>
</div>

<script>
    
</script>