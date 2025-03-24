<?php
/**
 * @var $data
 */
?>
<h3>My Calendar</h3>
<table class="table table-striped table-bordered">
    <thead>
    <tr>
        <th>Title</th>
        <th>Description</th>
        <th>Date</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($data['items'] as $event) : ?>
        <tr>
            <td><?= $event['title'] ?></td>
            <td><?= $event['description'] ?></td>
            <td>from: <?= dateFormat($event['startDate'], 'm/d/Y') . '<br>to: ' . dateFormat($event['endDate'], 'm/d/Y') ?></td>
            <td>
                <a href="<?= App\URL\Builder::absolute('events/' . $event['id']) ?>" class="btn btn-light">
                    <i class="fas fa-eye"></i> View details
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<div class="d-flex justify-content-center">
    <?= App\Template\Engine::Pagination($data['total'], $_GET['limit'] ?? 5, $_GET['page'] ?? 0, '/events') ?>
</div>
