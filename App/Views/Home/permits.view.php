<?php
/** @var \Framework\Support\LinkGenerator $link */
/** @var \Framework\Support\View $view */

$view->setLayout('root');
?>

<head>
    <link rel="stylesheet" href="<?= $link->asset('/css/permits.css') ?>">
</head>

<div class="permits-hero">
    <h1>Cenník</h1>
    <h2>Pernamentka</h2>

    <div class="container">

        <div class="rectengle">
            <div class="rect-header">
                <h3>Týždenná</h3>
            </div>

            <div class="rect-body">
                <p>Dĺžka trvania: <span>7 dní</span></p>
                <p>Celková cena: <span>15 €</span></p>
                <p>Cena za deň: <span>2.14 € / deň</span></p>
            </div>

            <button class="button-green btn btn-primary" type="submit" name="submit">Kúpiť</button>
        </div>

        <div class="rectengle">
            <div class="rect-header">
                <h3>Mesačná</h3>
            </div>

            <div class="rect-body">
                <p>Dĺžka trvania: <span>30 dní</span></p>
                <p>Celková cena: <span>45 €</span></p>
                <p>Cena za deň: <span>1.50 € / deň</span></p>
            </div>

            <button class="button-green btn btn-primary" type="submit" name="submit">Kúpiť</button>
        </div>

        <div class="rectengle">
            <div class="rect-header">
                <h3>Ročná</h3>
            </div>

            <div class="rect-body">
                <p>Dĺžka trvania: <span>365 dní</span></p>
                <p>Celková cena: <span>400 €</span></p>
                <p>Cena za deň: <span>1.10 € / deň</span></p>
            </div>

            <button class="button-green btn btn-primary" type="submit" name="submit">Kúpiť</button>
        </div>
    </div>
</div>
