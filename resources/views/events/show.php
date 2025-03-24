<?php
/**
 * @var $event
 */
?>
<h3>Event: <?= $event['title'] ?></h3>
<table class="table table-bordered table-striped">
    <tr>
        <td>Description:</td>
        <td><?= $event['description'] ?></td>
    </tr>
    <tr>
        <td>Start Date:</td>
        <td><?= dateFormat($event['startDate']) ?></td>
    </tr>
    <tr>
        <td>End Date:</td>
        <td><?= dateFormat($event['endDate']) ?></td>
    </tr>
</table>
<a href="<?= App\URL\Builder::absolute('events') ?>" class="btn btn-light">
    <i class="fas fa-arrow-left"></i> Back
</a>