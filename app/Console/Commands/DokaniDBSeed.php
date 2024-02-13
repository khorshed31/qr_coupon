<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class DokaniDBSeed extends Command
{
    protected $signature = 'dokani:seed';

    protected $description = 'Seeds Product Related Tables';

    public function handle()
    {
        Artisan::call('db:seed', [
            '--class' => 'Module\Dokani\database\seeds\DatabaseSeeder'
        ]);

        $this->info('Product tables seeded successfully!');
    }
}
