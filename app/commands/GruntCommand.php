<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class GruntCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'grunt';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run a grunt task';

    protected $node_path = null;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->node_path = exec('which node');
        // Is node available?
        if(strlen($this->node_path) == 0){
            // Heroku installs node here
            if(File::exists('vendor/node/bin/node')){
                $this->node_path = realpath('vendor/node/bin/node');
            }
        }
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {
        $tasks = $this->argument('tasks');

        $this->info("Running grunt {$tasks}");
        $this->info(passthru("{$this->node_path} node_modules/grunt-cli/bin/grunt {$tasks}"));
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return array(
            array('tasks', InputArgument::OPTIONAL, 'Grunt task to run', '')
        );
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
