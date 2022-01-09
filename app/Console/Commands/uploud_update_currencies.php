<?php

namespace App\Console\Commands;

use App\Http\Controllers\CurrenciesController;
use Illuminate\Console\Command;

class uploud_update_currencies extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'uploud_update_currencies';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Загружает/обновляет информацию о валютах в базу данных mysql';

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
    public function handle(CurrenciesController $Cur)
    {
        $Cur->create();
    }
}
