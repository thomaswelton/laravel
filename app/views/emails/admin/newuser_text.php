Hey <?= $user->first_name ?>,

A new user account has been created for you at <?= URL::to('/') ?>

login: <?= $user->email ?>
pass: <?= $password ?>

Login Now - <?= $loginLink ?>
