<?php

namespace App\Jobs;

use App\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class NotifyAdmins implements ShouldQueue
{
    protected $post;

    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        echo("Dentro metodo handle: " . date('h:i:s') . "\n");
        echo("JOB RUNNING: Notify admin up post update: " . $this->post->title);
        // sleep(8);
        echo("Fine metodo handle: " . date('h:i:s') . "\n");

        $exitCode = Artisan::call('bitsense:email-for-post', [
            'post_id' => $this->post->id
        ]);
    }
}
