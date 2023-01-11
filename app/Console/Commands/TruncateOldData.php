<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\facades\DB;
use App\Models\Agenda;
use App\Models\Agendamento;
use Carbon\Carbon;
class TruncateOldData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'agendas:truncate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Excluir agendamentos que ja expiraram';

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
       // DB::table('agendas')->where('start','<', now())->delete();
    }
    
}
