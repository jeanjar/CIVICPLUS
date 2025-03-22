<h3>Events</h3>
<?= !count($data['items'] ?? []) ? App\Template\Engine::alert('No data', 'warning') : '' ?>
<?= isset($error) ? App\Template\Engine::alert($error, 'danger') : '' ?>

<table class="table table-striped table-bordered">
    <thead>
    <tr>
        <th>Title</th>
        <th>Description</th>
        <th>Date</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($data['items'] as $event) : ?>
        <tr>
            <td><?= $event['title'] ?></td>
            <td><?= $event['description'] ?></td>
            <td><?= dateFormat($event['startDate']) . ' - ' . dateFormat($event['endDate']) ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>