<?php

namespace Alloys9\PaystackRahisi\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class InstallPaystackRahisiPackage extends Command
{
    protected $signature = 'paystack-rahisi:install';
    protected $description = 'Install the Paystack Rahisi package';

    protected $files;

    public function __construct(Filesystem $files)
    {
        parent::__construct();
        $this->files = $files;
    }

    public function handle()
    {
        $this->info('Installing Paystack Rahisi package...');

        $this->copyControllers();
        $this->copyMigrations();
        $this->copyModels();
        $this->copyViews();
        $this->appendRoutes();

        $this->info('Paystack Rahisi package installed successfully.');
    }

    protected function copyControllers()
    {
        $this->info('Copying controllers...');
        $this->copyDirectory(__DIR__ . '/../../Controllers', app_path('Http/Controllers'));
    }

    protected function copyMigrations()
    {
        $this->info('Copying migrations...');
        $this->copyDirectory(__DIR__ . '/../../database/migrations', database_path('migrations'));
    }

    protected function copyModels()
    {
        $this->info('Copying models...');
        $this->copyDirectory(__DIR__ . '/../../Models', app_path('Models'));
    }

    protected function copyViews()
    {
        $this->info('Copying views...');
        $this->copyDirectory(__DIR__ . '/../../resources/views', resource_path('views'));
    }

    protected function appendRoutes()
    {
        $this->info('Appending route files...');
        $this->appendToFile(base_path('routes/web.php'), __DIR__ . '/../../routes/web.php');
    }


    protected function copyDirectory($src, $dest)
    {
        if (!$this->files->exists($src)) {
            $this->error("Source directory $src does not exist.");
            return;
        }

        $this->files->copyDirectory($src, $dest);
    }

    protected function appendToFile($targetFile, $sourceFile)
    {
        if (!$this->files->exists($sourceFile)) {
            $this->error("Source file $sourceFile does not exist.");
            return;
        }

        $sourceContent = $this->files->get($sourceFile);
        $this->files->append($targetFile, "\n" . $sourceContent);
    }
}
