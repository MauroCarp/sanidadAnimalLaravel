<?php

namespace App\Jobs;

use App\Backup;
use DateTime;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class BackupProcess implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $backup = new Backup();
        $backup->status = 'Pending';
        $backup->url = 'http://localhost';
        $backup->save();

        $date = date('Y-m-d_H:m:i');
        $path = storage_path() . '/app/public/backups/backup_' . $date;

        $cmd = 'mysqldump --column-statistics=0 -u root --databases sanidadanimal > ' . $path . '.sql';
        exec($cmd,$output,$err);

        sleep(10);
        $backup->status = 'Done';
        
        $backup->url = 'storage/backups/backup_' . $date . '.sql';
        
        $backup->save();

     }
}
