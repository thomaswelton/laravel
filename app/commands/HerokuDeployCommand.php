<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class HerokuDeployCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'heroku:deploy';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Deploy the app to a new server instance';

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
		$name = $this->option('name');
		
		$this->info('Creating application');
		echo `heroku apps:create -b https://github.com/heroku/heroku-buildpack-php.git --region eu`;
		echo `heroku config:add BUILDPACK_URL=git://github.com/ddollar/heroku-buildpack-multi.git`;
			
		$this->info('Installing cleardb addon');
		echo `heroku addons:add cleardb:ignite`;

		$this->info('Installing sendgrid addon');
		echo `heroku addons:add sendgrid:starter`;
		
		if(!is_null($name)){
			$this->info('Changing project name');
			echo `heroku apps:rename {$name}`;
		}

		$this->info('Pushing master branch to Heroku');
		echo `git push heroku master`;

		$this->info('Scaling app');
		echo `heroku ps:scale web=1`;

	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
			//array('example', InputArgument::REQUIRED, 'An example argument.'),
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
			array('name', null, InputOption::VALUE_OPTIONAL, 'Server name.', null),
		);
	}

}