<?php

namespace App\Console\Commands;

use App\Models\Module;
use Illuminate\Console\Command;

class ListModules extends Command
{
    protected $signature = 'modules:list';
    protected $description = 'List all modules with their details';

    public function handle()
    {
        $modules = Module::all();

        $headers = ['ID', 'Code', 'Name', 'Coefficient'];
        $rows = [];

        foreach ($modules as $module) {
            $rows[] = [
                $module->id,
                $module->code,
                $module->name,
                $module->coefficient
            ];
        }

        $this->table($headers, $rows);
        
        $this->info("\nTotal modules: " . $modules->count());
    }
} 