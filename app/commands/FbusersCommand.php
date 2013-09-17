<?php

use Symfony\Component\Console\Input\InputArgument;
use Illuminate\Console\Command;
use Thomaswelton\LaravelOauth\Eloquent\Facebook;

class FbusersCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'fb:users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install dummy data for the users table from Facebook';

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
        $this->info('Seeding table');

        Eloquent::unguard();

        // Configuring curl options
        $options = array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => array('Content-type: application/json')
        );

        $start = $this->argument('start');
        $userGroup = Sentry::getGroupProvider()->findByName('user');

        for ($i= $start; $i < $start + 250; $i++) {
            // jSON URL which should be requested
            $json_url = 'http://graph.facebook.com/' . $i;

            $this->info('Querying ' . $json_url);

            // Initializing curl
            $ch = curl_init( $json_url );

            // Setting curl options
            curl_setopt_array( $ch, $options );

            // Getting results
            $result =  curl_exec($ch); // Getting jSON result string
            $json = json_decode($result);

            if(is_object($json) && !property_exists($json, 'error')){
                $this->info('Creating ' . $json->first_name . ' ' . $json->last_name);

                $user = Sentry::register(array(
                    'first_name' => $json->first_name,
                    'last_name' => $json->last_name,
                    'email' => strtolower($json->first_name . '_' . $json->last_name) . '_' . $i . '@facebook.com',
                    'password' => 'password'
                ), true);

                $user->addGroup($userGroup);

                Facebook::create(array(
                    'user_id' => $user->id,
                    'oauth_uid' => $i
                ));
            }else{
                $this->error($json->error->message);
            }
        }

    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return array(
            array('start', InputArgument::OPTIONAL, 'Start ID', 0)
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
