<?php

$I = new WebGuy($scenario);
$I->wantTo('ensure that frontpage works');
$I->amOnPage('/');
$I->see('You have arrived.','h1');

$I = new WebGuy($scenario);
$I->wantTo('ensure that the admin form requires password');
$I->amOnPage('/admin/login');
$I->fillField('#email', 'davert');
$I->click('form button[type=submit]');
$I->see('Password field is required.');

$I = new WebGuy($scenario);
$I->wantTo('ensure that the admin form works');
$I->amOnPage('/admin/login');
$I->fillField('#email', 'admin@example.com');
$I->fillField('#password', 'password');
$I->click('form button[type=submit]');
$I->seeCurrentUrlEquals('/admin');
$I->see('Administration', 'h1');
