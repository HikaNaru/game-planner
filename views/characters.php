<?php
    use GamePlanner\Libraries\App;
    use GamePlanner\Libraries\Data;

    $characters = Data::getCharacters($game);
?>

<extend>page</extend>

<section content>
<h1 class="title">Characters</h1>
<div class="character-container">
<?php foreach ($characters as $character): ?>
    <a href="<?= 'characters/' . strtolower(App::get($character, 'name')) ?>" class="character-wrapper">
        <img src="<?= App::image($game . '/characters/' . App::get($character, 'icon')) ?>" alt="<?= App::get($character, 'name') ?>">
        <span class="character-name"><?= App::get($character, 'name') ?></span>
    </a>
<?php endforeach ?>
</div>
</section>