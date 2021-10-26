<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Livro;
use League\Csv\Reader;
use League\Csv\Statement;

class ImportLivro extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'importlivros {path}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Importa Livros';

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
            $tombo = (int) $row['tombo'];
            $tombo_tipo = trim($row['tombo_tipo']);

            $livro = Livro::where('tombo',$tombo)->where('tombo_tipo',$tombo_tipo)->first();
            if(!$livro){
                $livro = new Livro;
                $livro->tombo = $tombo;
                $livro->tombo_tipo = $tombo_tipo;
            }

            $livro->titulo = $row['titulo'];
            $livro->autor = $row['autor'];
            $livro->editora = $row['editora'];
            $livro->local = $row['local'];
            $livro->ano = (int) $row['ano'];
            $livro->edicao = (int) $row['edicao'];
            $livro->exemplar = (int) $row['exemplar'];
            $livro->volume = $row['volume'];

            $livro->localizacao = $row['localizacao'];

            if(!empty($row['edicao']) && (int) $row['edicao'] != 1) $livro->localizacao .= ' ' . (int) $row['edicao'] . '.ed.';
            if(!empty($row['volume'])) $livro->localizacao .= ' v.' . $row['volume'];
            if(!empty($row['exemplar']) && (int) $row['exemplar'] != 1) $livro->localizacao .= ' e.' . (int) $row['exemplar'];
           
            
            if(!empty($row['cor'])) $livro->localizacao .= ' ' . $row['cor'];

            $livro->save();       
        } 

        return 0;
    }
}
