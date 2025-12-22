<?php
/** @var array|\Traversable $accounts */
/** @var \Framework\Auth\AppUser $user */
/** @var \Framework\Support\LinkGenerator $link */
/** @var string|null $message */

use App\Models\Account;


?>

<head>
    <link rel="stylesheet" href="<?= $link->asset('/css/admin.css') ?>">
</head>

<div class="container-fluid">
    <div class="row">
        <div class="col">
            <h4>Transactions</h4>
            <div class="text-center text-danger mb-3">
                <?= @$message ?>
            </div>
        </div>
    </div>
</div>