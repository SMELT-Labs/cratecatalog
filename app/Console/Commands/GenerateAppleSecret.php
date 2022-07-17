<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Jackiedo\DotenvEditor\Facades\DotenvEditor;
use Symfony\Component\Process\Process;

class GenerateAppleSecret extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:apple';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a secret key for Apple oAuth';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $process = new Process(['ruby', 'generate_apple_secret.rb']);

        $process->run();

        if ($process->isSuccessful()) {
            $env = DotenvEditor::load();
            $secret = trim($process->getOutput());
            $env->setKeys([
                "SOCIALITE_APPLE_SECRET" => $secret
            ])->save();

//            DotenvEditor::save();
//            putenv("SOCIALITE_APPLE_SECRET=$secret");
        }
    }
}
