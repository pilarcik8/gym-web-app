<?php
/** @var \Framework\Auth\AppUser $user */
/** @var \Framework\Support\LinkGenerator $link */
/** @var string|null $message */

?>

<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="text-center text-danger mb-3">
                <?= @$message ?>
            </div>
        </div>
    </div>
</div>