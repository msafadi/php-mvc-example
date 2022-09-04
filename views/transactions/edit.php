<h1>Edit Transaction</h1>

<form action="index.php?controller=transactions&action=edit&id=<?= $id ?>" method="post">

    <div class="row mb-3">
        <label for="amount" class="col-sm-2 col-form-label">Amount</label>
        <div class="col-sm-10">
            <input type="number" class="form-control" id="amount" name="amount" value="<?= htmlspecialchars($transaction['amount']) ?>">
        </div>
    </div>
    <div class="row mb-3">
        <label for="description" class="col-sm-2 col-form-label">Description</label>
        <div class="col-sm-10">
            <textarea class="form-control" id="description" name="description"><?= htmlspecialchars($transaction['description']) ?></textarea>
        </div>
    </div>
    <div class="row mb-3">
        <label for="tag_id" class="col-sm-2 col-form-label">Tag</label>
        <div class="col-sm-10">
            <select class="form-select" id="tag_id" name="tag_id">
                <option></option>
                <?php
                $tagModel = new \Models\Tag($GLOBALS['db']);
                foreach ($tagModel->fetch() as $row) :
                ?>
                    <option value="<?= $row['id'] ?>" <?= ($row['id'] == $transaction['tag_id'])? 'selected' : '' ?>>
                        <?= $row['name'] ?>
                    </option>
                <?php endforeach ?>
            </select>
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Update Transaction</button>

</form>