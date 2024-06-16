<?php
    use GamePlanner\Libraries\App;
    use GamePlanner\Libraries\Data;

    $navs = Data::getNav();
?>

<div class="navigation" x-data="navigation">
<?php foreach ($navs as $key => $nav): ?>
    <div class="nav" :class="'<?= $key ?>' == 'genshinImpact' ? 'active' : ''" x-data="{isOpen: <?= 'false' ?>}">
        <div class="nav-wrapper" @click="isOpen = !isOpen">
            <div>
                <img src="<?= App::image($key . '/' . App::get($nav, 'icon')) ?>" alt="<?= App::get($nav, 'label') ?>">
                <label><?= App::get($nav, 'label') ?></label>
            </div>
            <span class="material-symbols" x-text="isOpen ? 'arrow_drop_down' : 'arrow_right'"></span>
        </div>
<?php if (App::get($nav, 'subnav', [])): ?>
        <div class="subnav" :class="isOpen ? 'collapsed' : ''">
<?php foreach (App::get($nav, 'subnav', []) as $sub): ?>
            <div><?= App::get($sub, 'label') ?></div>
<?php endforeach ?>
        </div>
<?php endif ?>
    </div>
<?php endforeach ?>
</div>

<script>
    function navigation() {
        return {
            init: function() {

            }
        }
    }
</script>