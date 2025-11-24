<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class CheckEnv extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:env {--fix}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check and optionally fix environment variables';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $envPath = base_path('.env');

        if (!File::exists($envPath)) {
            $this->error('.env file not found!');
            return;
        }

        $this->info('Checking .env file...');

        $content = File::get($envPath);
        $lines = explode("\n", $content);
        $fixed = false;

        foreach ($lines as $index => $line) {
            if (strpos($line, 'CACHE_STORE=databasel') === 0) {
                $this->warn("Found incorrect CACHE_STORE: {$line}");
                if ($this->option('fix')) {
                    $lines[$index] = 'CACHE_STORE=file';
                    $fixed = true;
                    $this->info('Fixed CACHE_STORE to file');
                }
            }
        }

        if ($fixed) {
            File::put($envPath, implode("\n", $lines));
            $this->info('Environment file updated.');
        } else {
            $this->info('No issues found in .env file.');
        }

        // Check current environment
        $this->info('Current CACHE_STORE: ' . env('CACHE_STORE', 'not set'));
        $this->info('Current MAIL_MAILER: ' . env('MAIL_MAILER', 'not set'));
    }
}
