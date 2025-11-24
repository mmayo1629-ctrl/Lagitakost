<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class FixCacheConfig extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fix:cache-config';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fix cache configuration issues';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Checking cache configuration...');

        // Check if there's a cached config file
        $configCachePath = base_path('bootstrap/cache/config.php');
        if (File::exists($configCachePath)) {
            $this->info('Removing cached config file...');
            File::delete($configCachePath);
        }

        // Check cache.php config
        $cacheConfigPath = config_path('cache.php');
        $content = File::get($cacheConfigPath);

        // Check if default is set to 'databasel' or similar typo
        if (strpos($content, "'default' => env('CACHE_STORE', 'databasel')") !== false) {
            $this->warn('Found incorrect cache default configuration');
            $newContent = str_replace("'default' => env('CACHE_STORE', 'databasel')", "'default' => env('CACHE_STORE', 'file')", $content);
            File::put($cacheConfigPath, $newContent);
            $this->info('Fixed cache default to file');
        }

        $this->info('Cache configuration fixed. Clearing and recaching...');

        // Clear config cache
        $this->call('config:clear');
        $this->call('cache:clear');

        $this->info('Configuration cleared and cache cleared successfully.');
    }
}
