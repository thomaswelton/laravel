<div class="control-group <?php if($errors->has($field)) echo 'error' ?>">
    <?= $label ?>
    <div class="controls">
        <?= $input ?>
        <?php if($errors->has($field)): ?>
        	<span class="help-inline"><?= $errors->first($field) ?></span>
        <?php endif; ?>
    </div>
</div>