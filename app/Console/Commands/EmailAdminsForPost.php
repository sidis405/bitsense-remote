<?php

namespace App\Console\Commands;

use App\Post;
use Illuminate\Console\Command;
use App\Mail\PostNeedsVerification;
use Illuminate\Support\Facades\Mail;

class EmailAdminsForPost extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = "bitsense:email-for-post {post_id}";

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notify Admins For Post Update';

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
    public function handle()
    {
        $this->info("Sending email");

        $post = Post::where('id', intval($this->argument('post_id')))->first();


        if ($post) {
            Mail::to("forge405@gmail.com")->send(new PostNeedsVerification($post));
        } else {
            $this->error("No post found");
        }
    }
}
