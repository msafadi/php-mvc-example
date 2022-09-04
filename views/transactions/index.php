
<h1 class="mb-5">
    Transactions 
    <small><a href="index.php?controller=transactions&action=create" class="btn btn-sm btn-primary">Create</a></small>
</h1>

<?php if ($msg = $this->flashMessage('success')) : ?>
    <div class="alert alert-success">
        <?= $msg ?>
    </div>
<?php endif ?>

<p><?= ini_get('memory_limit') ?></p>

<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Amount</th>
            <th>Desc.</th>
            <th>Tag</th>
            <th>Time</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($transactions as $row) : ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['amount'] ?></td>
            <td><?= $row['description'] ?></td>
            <td><?= $row['tag_id'] ?></td>
            <td><?= $row['created_at'] ?></td>
            <td><a href="index.php?controller=transactions&action=edit&id=<?= $row['id'] ?>" class="btn btn-sm btn-success">Edit</a></td>
        </tr>
        <?php endforeach ?>
    </tbody>
</table>
