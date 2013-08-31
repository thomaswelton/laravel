<div class="form-group <?php if($errors->has($field)) echo 'error' ?>">
    <?= $label ?>
    <div class="col-sm-6">
        <?= $input ?>
        <?php if($errors->has($field)): ?>
            <span class="help-inline"><?= $errors->first($field) ?></span>
        <?php endif; ?>
    </div>
</div>
