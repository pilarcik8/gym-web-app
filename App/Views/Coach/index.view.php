<?php
/** @var \Framework\Auth\AppUser $user */
/** @var \Framework\Support\LinkGenerator $link */
/** @var string|null $message */

$trainer_id = $user->getID();
$groupClasses = \App\Models\Group_Class::getAll('`trainer_id` = ?', [$trainer_id]);

function splitDateTime($datetimeString) {
    $dt = new DateTime($datetimeString);

    $date = $dt->format('d.m. Y');
    $time = $dt->format('H:i');

    return [$date, $time];
}
?>

<head>
    <link rel="stylesheet" href="<?= $link->asset('/css/coach-panel.css') ?>">
</head>

<div class="container-fluid">
    <div class="row">
        <div class="col">
            <h4>Your Group Trainings</h4>
            <div class="text-center text-danger mb-3">
                <?= @$message ?>
            </div>
            <table id="table" class="table table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Meno</th>
                    <th>Dátum</th>
                    <th>Čas</th>
                    <th>Dĺžka trvania (min)</th>
                    <th>Kapacita</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($groupClasses as $gc):
                    $arr = splitDateTime($gc->getStartDatetime());
                    $date = $arr[0];
                    $time = $arr[1];
                ?>
                    <tr>
                        <td><?= $gc->getId() ?></td>
                        <td><?= $gc->getName() ?></td>
                        <td><?= $date ?></td>
                        <td><?= $time ?></td>
                        <td><?= $gc->getDurationMinutes() ?></td>
                        <td>0/<?= $gc->getCapacity() ?></td>
                        <td>
                            <a href="">Edit</a> |
                            <a href="" onclick="return confirm('Delete?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach;
                if (empty($groupClasses)): ?>
                    <tr>
                        <td colspan="6" class="text-center">Nemáte žiadne skupinové hodiny naplánované.</td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
        <hr>
        <div id="form-create-class">
            <div>
                <h4>Vytvoriť skupinovú hodinu</h4>
                <form action="<?= $link->url('createGroupClass') ?>" method="post" class="row">
                    <div class="col-md-8">
                        <label for="gc-name" class="form-label">Pomenovanie</label>
                        <input id="gc-name" name="name" type="text" class="form-control" required maxlength="255" />
                    </div>

                    <div class="col-md-2">
                        <label for="gc-capacity" class="form-label">Kapacita</label>
                        <input id="gc-capacity" name="capacity" type="number" class="form-control" required min="1" value="20" />
                    </div>

                    <div class="col-md-3">
                        <label for="gc-date" class="form-label">Dátum</label>
                        <input id="gc-date" name="date" type="datetime-local" class="form-control" required"/>
                    </div>

                    <div class="col-md-3">
                        <label for="gc-duration" class="form-label">Dĺžka trvania (minúty)</label>
                        <input id="gc-duration" name="duration_minutes" type="number" class="form-control" required min="1" value="60" />
                    </div>

                    <div class="col-md-10">
                        <label for="gc-description" class="form-label">Popis</label>
                        <textarea id="gc-description" name="description" class="form-control" rows="3" maxlength="1000"></textarea>
                    </div>

                    <input type="hidden" name="trainer_id" value="<?= $trainer_id ?>" />

                    <div class="col-12">
                        <button type="submit" id="button" name="createGroupClass" class="btn btn-primary">Vytvor</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>