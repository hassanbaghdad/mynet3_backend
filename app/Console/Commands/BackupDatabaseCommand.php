<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Spatie\DbDumper\Databases\MySql;
use App\Models\backups_model;
use Illuminate\Http\Request;

use Spatie\Multitenancy\Models\Tenant;


class BackupDatabaseCommand extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'backup:database';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Database Backup';

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
     * @return int
     */
    public function handle()
    {
        $filename = date('Y-m-d-H-i-s').rand(100000,999999)."-backup.sql";
        //File::put('db.sql','');
        $tenant = new Tenant();
        if (!file_exists(public_path('app/backups/'.Tenant::current()->name))) {
            mkdir(public_path('app/backups/'.Tenant::current()->name, 0777, true));
        }
        MySql::create()
            ->setDbName(Tenant::current()->getDatabaseName())
            ->setUserName('mynetah1_lord')
            ->setPassword('Iq135137Iq@@')
            ->setHost(env('DB_HOST'))
            ->setPort(env('DB_PORT'))
            ->dumpToFile(public_path('app/backups/'.Tenant::current()->name.'/'.$filename));

        $backup = new backups_model();

        $backup->back_name = $filename;
        $backup->save();

        
    }

}
