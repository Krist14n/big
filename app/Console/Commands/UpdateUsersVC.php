<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;

class UpdateUsersVC extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'usersvc:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updates users vc every 30 minutes';

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
        //
        DB::table('users')->increment('vc', 0.25);
    }
}
