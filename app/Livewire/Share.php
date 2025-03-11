<?php

namespace App\Livewire;
use Livewire\WithFileUploads;
use Livewire\Component;
use App\Models\Conteudo;                  

class Share extends Component{


    use WithFileUploads;

    public $files = []; // Array para armazenar os arquivos
    public $preview = []; // Array para armazenar os previews

    // Limite de arquivos
    const MAX_FILES = 4;

    // Função para adicionar arquivo ao array
    public function updatedFiles()
    {
        // Verifica se o número de arquivos ultrapassou o limite
        if (count($this->files) > self::MAX_FILES) {
            $this->files = array_slice($this->files, 0, self::MAX_FILES);
        }
        
        // Gerar o preview dos arquivos
        foreach ($this->files as $file) {
            $this->preview[] = $file->temporaryUrl();
        }
    }

    // Função para gravar os dados no banco
    public function save(){
        dd($this->file);
        // Validar a quantidade de arquivos
        if (count($this->files) > self::MAX_FILES) {
            session()->flash('error', 'Você não pode enviar mais de 4 arquivos.');
            return;
        }

        // Prepare os dados para salvar no banco como JSON
        $fileData = array_map(function ($file) {
            return [
                'name' => $file->getClientOriginalName(),
                'path' => $file->store('uploads', 'public'),
            ];
        }, $this->files);

        // Exemplo de gravação no banco em formato JSON
        Conteudo::create([
            'filesImg' => json_encode($fileData),
        ]);
        
        session()->flash('message', 'Arquivos enviados com sucesso!');
    }


    public function render(){
        return view('livewire.share');
    }
}
