<?php
    use GamePlanner\Libraries\App;
?>

<extend>page</extend>

<section content>
<div x-data="inventory">
    <h1 class="title">Inventory</h1>
    <div class="material-container">
        <?php foreach ($materials as $key => $material): ?>
        <div class="material-wrapper">
            <div class="image-wrapper">
                <?php if (strpos(App::get($material, 'name'), 'Resonance') !== false || strpos(App::get($material, 'name'), 'Energy') !== false): ?>
                <div class="material-text <?= App::get($material, 'rarity') ? 'rarity-' . App::get($material, 'rarity') : '' ?>"><?= strpos(App::get($material, 'name'), 'Resonance') ? 'Character Exp' : 'Weapon Exp' ?></div>
                <?php else: ?>
                <img class="material-image <?= App::get($material, 'rarity') ? 'rarity-' . App::get($material, 'rarity') : '' ?>" src="<?= App::image($game . '/materials/' . App::get($material, 'imageName')) ?>" alt="<?= App::get($material, 'name') ?>">
                <?php endif ?>
            </div>
            <div class="material-input">
                <input id="material-input-<?= $key ?>" type="number" value="0">
                <span @click="btnUpdateQty('decrease', <?= $key ?>)">-</span>
                <span @click="btnUpdateQty('increase', <?= $key ?>)">+</span>
            </div>
        </div>
        <?php endforeach ?>
    </div>
</div>
</section>

<script>
    function inventory() {
        return {
            btnUpdateQty: function (type, index) {
                let input = $('#material-input-' + index);
                let value = parseInt(input.val());
                let update = 1;
                if (this.$event.ctrlKey) {
                    update *= 100;
                } else if (this.$event.shiftKey) {
                    update *= 10;
                }
                if (type == 'decrease') {
                    update *= -1;
                }

                value = value + update;
                if (value < 0) {
                    value = 0;
                }
                input.val(value);
            },
        };
    }
</script>