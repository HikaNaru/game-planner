<?php
    use GamePlanner\Libraries\App;
    use GamePlanner\Libraries\Data;

    $navs = Data::getNav();
?>

<div class="navigation" x-data="navigation">
<?php foreach ($navs as $key => $nav): ?>
    <div class="nav" :class="navClasses('<?= $key ?>', '<?= $game ?>', <?= App::get($nav, 'subnav', []) ? 'true' : 'false' ?>)" x-data="{isOpen: <?= $key == $game ? 'true' : 'false' ?>}">
<?php if (App::get($nav, 'subnav', [])): ?>
        <div class="nav-wrapper" @click="isOpen = !isOpen">
            <div>
                <img src="<?= App::image($key . '/' . App::get($nav, 'icon')) ?>" alt="<?= App::get($nav, 'label') ?>" class="nav-image">
                <label><?= App::get($nav, 'label') ?></label>
            </div>
            <span class="material-symbols" x-text="isOpen ? 'arrow_drop_down' : 'arrow_right'"></span>
        </div>
        <div class="subnav" :class="isOpen ? 'collapsed' : ''">
<?php foreach (App::get($nav, 'subnav', []) as $sub): ?>
            <a href="<?= App::get($sub, 'url') ?>" :class="subnavClasses('<?= $key ?>', '<?= $game ?>', '<?= App::get($sub, 'label') ?>', '<?= $navActive ?>')">
                <?= App::get($sub, 'label') ?>
            </a>
<?php endforeach ?>
        </div>
<?php else: ?>
        <a href="/" class="nav-wrapper">
            <div>
                <div class="nav-image material-symbols">home</div>
                <label><?= App::get($nav, 'label') ?></label>
            </div>
        </a>
<?php endif ?>
    </div>
<?php endforeach ?>
</div>

<script>
    function navigation() {
        return {
            init: function() {

            },
            navClasses: (a, b, c) => {
                return {
                    'active': a.toLowerCase() == b.toLowerCase(),
                    'collapsible': c
                };
            },
            subnavClasses: (a, b, c, d) => {
                return {
                    'active': a.toLowerCase() == b.toLowerCase() && c.toLowerCase() == d.toLowerCase()
                };
            }
        }
    }
</script>