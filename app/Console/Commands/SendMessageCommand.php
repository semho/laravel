<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SendMessageCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'articles:sending
        {from : Начальная дата периода(формат ввода Y-m-d)}
        {to : Конечная дата периода(формат ввода Y-m-d)}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Рассылка статей за определенный период';

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
        $users = \App\Models\User::all();
        $from = $this->argument('from') . ' 00:00:00';
        $to = $this->argument('to') . ' 23:59:59';

        $articles = \App\Models\Article::whereBetween('created_at', [
            date($from),
            date($to)
        ])->get();

        $users->map->notify(new \App\Notifications\SendArticlesForUsers($articles, $from, $to));

        $this->info('Рассылка выполнена');
    }
}
