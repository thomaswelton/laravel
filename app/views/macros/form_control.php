<div class="form-group <?php if($errors->has($field)) echo 'has-error' ?>">
    <?= $label ?>
    <div class="col-sm-9">
        <?= $input ?>
    	<span class="error-message help-block"><? if($errors->has($field)) echo $errors->first($field) ?></span>
        <? if(isset($help)): ?>
        	<span class="help-block"><?= $help ?></span>
        <? endif ?>
    </div>
</div>
