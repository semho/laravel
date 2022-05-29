<?php

namespace App\Jobs;

use App\Mail\Report;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Tiding;
use App\Models\Article;
use App\Models\Comment;
use App\Models\Tag;
use App\Models\User;

class TotalReport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $admin;

    public $data = [];

    public $deleteWhenMissingModels = true;

    public function __construct(User $user = null, $data)
    {
        $this->admin = $user;
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        isset($this->data['news']) ? $this->data['news'] = "Новостей: " . Tiding::count() : "";
        isset($this->data['articles']) ? $this->data['articles'] = "Статей: " . Article::count() : "";
        isset($this->data['comments']) ? $this->data['comments'] = "Комментарий: " . Comment::count() : "";
        isset($this->data['tags']) ? $this->data['tags']= "Тегов: " . Tag::count() : "";
        isset($this->data['users']) ? $this->data['users'] = "Пользователей: " . User::count() : "";

        //отправляем отчет администратору на email
        \Mail::to($this->admin->email)->send(
            new Report($this->data, $this->getCsv())
        );
    }

    public function getCsv()
    {
        $dir = public_path() . '/reports';

        if (!is_dir($dir)) {
            mkdir($dir, 0777, True);
        }

        $filename = $dir . '/download.csv';

        if (is_file($filename)) {
            unlink($filename);
        }

        $handle = fopen($filename, 'w+');

        foreach ($this->data as $row) {
            fputcsv($handle, [$row]);
        }

        fclose($handle);

        return $filename;
    }

}
