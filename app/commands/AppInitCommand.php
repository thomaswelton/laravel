<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class AppInitCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'app:init';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Run database migrations, install sample data, compile assets and install dependencies';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return void
	 */
	public function fire()
	{
		$this->info('Running Database migrations');
		echo `php artisan migrate:install`;
		echo `php artisan migrate`;
		echo `php artisan migrate --package=cartalyst/sentry`;
		echo `php artisan db:seed`;

		$this->info('Installing node modules');
		echo `npm install`;

		$this->info('Running Grunt');
		echo `grunt`;

	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
			
		);
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array(
			
		);
	}

}