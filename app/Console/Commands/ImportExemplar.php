<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Livro;
use App\Models\Responsabilidade;
use App\Models\Instance;

use League\Csv\Reader;
use League\Csv\Statement;

class ImportExemplar extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'importexemplar {path}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Importa Exemplar';

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
     * @return int
     */
    public function handle()
    {
        $path = $this->argument('path');
        $reader = Reader::createFromPath($path, 'r');
        
        // Importar os novos
        $reader->setHeaderOffset(0);
        $records = $reader->getRecords();

        foreach($records as $row){

            $livro = new Livro;
            $livro->titulo = trim($row['titulo']);
            $livro->save();
            
            if (!empty(trim($row['autor']))){
                $responsabilidade = Responsabilidade::where('nome',trim($row['autor']))->first();
                if(!$responsabilidade) {
                    $responsabilidade = new Responsabilidade;
                    $responsabilidade->nome = trim($row['autor']);
                    $responsabilidade->save();
                }
    
                $livro->responsabilidades()->attach($responsabilidade->id, ['tipo' => 'Autor']);
                $livro->save();
            }

            $instance =  new Instance;
            $instance->tombo =  trim($row['tombo']);
            $instance->livro_id = $livro->id;
            $instance->tombo_tipo = 'Padrão';
            $instance->save();

        } 

        return 0;
    }
}
