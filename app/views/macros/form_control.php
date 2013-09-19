<div class="form-group <?php if($errors->has($field)) echo 'has-error' ?>">
    <?= $label ?>
    <div class="col-sm-9">
        <?= $input ?>
        <?php if($errors->has($field)): ?>
            <span class="help-block"><?= $errors->first($field) ?></span>
        <?php endif; ?>
        <? if(isset($help)): ?>
        	<span class="help-block"><?= $help ?></span>
        <? endif ?>
    </div>
</div>
