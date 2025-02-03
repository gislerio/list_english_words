<?php

namespace App\Console\Commands;

use App\Services\ImportWordsService;
use Illuminate\Console\Command;

class ImportWords extends Command
{
    protected $signature = 'app:import-words {file}';
    protected $description = 'Importa palavras de um arquivo de texto para o banco de dados';

    public function __construct(private ImportWordsService $importWordsService)
    {
        parent::__construct();
    }

    public function handle()
    {
        $filePath = $this->argument('file');

        if (!file_exists($filePath)) {
            $this->error("Arquivo não encontrado: {$filePath}");
            return Command::FAILURE;
        }

        try {
            $this->importWordsService->importWords($filePath);
            $this->info("Importação concluída com sucesso!");
            return Command::SUCCESS;
        } catch (\Exception $e) {
            $this->error("Erro durante a importação: " . $e->getMessage());
            return Command::FAILURE;
        }
    }
}
