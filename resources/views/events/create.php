<h3>Create Event</h3>
<?= isset($error) ? App\Template\Engine::alert($error, 'danger') : '' ?>

<form action="<?= App\Link\Builder::absolute('events'); ?>" method="post">
    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control" id="title" name="title" required>
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" id="description" name="description" required></textarea>
    </div>
    <div class="mb-3">
        <label for="startDate" class="form-label">Start Date</label>
        <input type="date" class="form-control" id="startDate" name="startDate" required>
    </div>
    <div class="mb-3">
        <label for="endDate" class="form-label">End Date</label>
        <input type="date" class="form-control" id="endDate" name="endDate" required>
    </div>
    <div class="mb-3 d-flex justify-content-between">
        <a href="<?= App\Link\Builder::absolute('') ?>" class="btn btn-secondary">Back</a>
        <button type="submit" class="btn btn-primary">Create</button>
    </div>
</form>