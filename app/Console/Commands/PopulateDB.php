<?php

namespace App\Console\Commands;

use App\Post;
use App\User;
use Illuminate\Console\Command;

class PopulateDB extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = "bitsense:populate {users : Number of users to create}
    {--P|posts=0 : Number of posts per user.}";

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Fake Data';

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
        $totalUsers = intval($this->argument('users'));
        $totalPostsPerUser = intval($this->option('posts'));

        $this->info("Will create " . $totalUsers . " users");

        $users = factory(User::class, $totalUsers)->create();





        if ($totalPostsPerUser) {
            $bar = $this->output->createProgressBar($totalUsers * $totalPostsPerUser);


            foreach ($users as $user) {
                sleep(1);
                $posts = factory(Post::class, $totalPostsPerUser)->create(['user_id' => $user->id]);

                $bar->advance();
            }
        }
    }
}
