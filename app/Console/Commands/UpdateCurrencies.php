<?php

namespace App\Console\Commands;

use App\Services\CurrencyService;
use Illuminate\Console\Command;

class UpdateCurrencies extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'currency:update
                            {char_code? : Char code for update only one currency}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update currencies';

    /**
     * Create a new command instance.
     *
     * @param CurrencyService $service
     */
    public function __construct(
        private CurrencyService $service
    ){
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $char_code = $this->argument('char_code');
        $this->line('Starting update');
        if($count = $this->service->update($char_code ? [$char_code] : null)){
            $this->info("Successful updated {$count} currencies!");
            return 0;
        }
        $this->error('No currencies updated (maybe char_code not right?)');
        return 1;
    }
}
