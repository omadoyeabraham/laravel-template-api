<?php

namespace App\Console\Commands;

use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class SetPassportPasswordClientSecret extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'passport:set-password-client-secret';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return mixed
     */
    public function handle()
    {
        try {
            DB::update('update oauth_clients set secret = ? where id = ?', [
                'jNO4sPhKn75lDntkJiNbcF1mtl5CZ9XqWHcfMM8x',
                2
            ]);
            $this->info("Successfully set the passport client to jNO4sPhKn75lDntkJiNbcF1mtl5CZ9XqWHcfMM8x");
        } catch (Exception $e) {
            $this->error('Unable to set the passport client to jNO4sPhKn75lDntkJiNbcF1mtl5CZ9XqWHcfMM8x');
        }
    }
}
