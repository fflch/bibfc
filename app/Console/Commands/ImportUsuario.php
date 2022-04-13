<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Usuario;
use League\Csv\Reader;
use League\Csv\Statement;

class ImportUsuario extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'importusuarios {path}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Importa Usuários';

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
        
        // Zerar o campo turma dos atuais
        foreach(Usuario::all() as $usuario){
            $usuario->turma = 'Sem matrícula ativa';
            $usuario->save();
        }

        // colunas do arquivo csv: matricula, nome, telefone, turma, situacao
        // Importar os novos
        $reader->setHeaderOffset(0);
        $records = $reader->getRecords();

        foreach($records as $row){
            $matricula = (int) $row['matricula'];

            $usuario = Usuario::where('matricula',$matricula)->first();
            if(!$usuario){
                $usuario = new Usuario;
                $usuario->matricula = $matricula;
            }

            $usuario->nome = $row['nome'];
            $usuario->telefone = $row['telefone'];
            $usuario->turma = $row['situacao'] . ' - ' . $row['turma'];
            $usuario->save();       
        }
        return 0;
    }
}
