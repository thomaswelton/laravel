<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class HerokuCompileCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'heroku:compile';

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
        // Build the optimised class loader
        $this->call('optimize');

        // Production and staging have CDN assets
        if('production' == App::environment() || 'staging' == App::environment()){
            $this->call('cdn:sync', array('path' => 'public/assets', '--trim' => 'public'));
        }
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return array();
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return array();
    }

}
