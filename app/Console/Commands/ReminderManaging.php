<?php

namespace App\Console\Commands;

use App\Http\Controllers\Admin\Reminder as Reminder;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class ReminderManaging extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:reminder_managing';

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
     * @return int
     */
    public function handle()
    {
        (new Reminder)->sendReminderEmailManagingEditor();
        Log::info('blog publis is running');
        return Command::SUCCESS;
    }
}
