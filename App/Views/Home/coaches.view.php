<?php
/** @var \Framework\Support\LinkGenerator $link */
?>

<head>
    <title>Treneri</title>
    <link rel="stylesheet" href="<?= $link->asset('/css/coaches.css') ?>">
</head>

<body>
    <div class="hero-wrapper">
        <img src="<?= $link->asset('/images/couches-hero.png') ?>" alt="Trener joga" class="hero-img">

        <div class="text-bubble">
            <h2>NAŠI <span>TRÉNERI</span> </h2>
            <p>sú tu, aby vám pomohli dosiahnuť <span>vaše ciele</span></p>
        </div>
    </div>

    <div class="custom-section">
        <div class="left-side">
            <div class="square"></div>
            <div class="cut-triangle"></div>
        </div>

        <img src="<?= $link->asset('/images/coach-1.png') ?>" alt="trener1" class="right-image">
    </div>
</body>


