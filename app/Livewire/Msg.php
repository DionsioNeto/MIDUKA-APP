<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class Mgs extends Component{
    use WithFileUploads;

    public $file;
    public $fileUrl;
    public $fileType;

    // Regras de validação para tipos de arquivos permitidos
    protected $rules = [
        'file' => 'nullable|mimes:jpg,jpeg,png,bmp,tiff,webp,mp4,mp3,pdf|max:10240', // Permitindo diferentes tipos de arquivos
    ];

    // Atualizar o arquivo e gerar URL temporária
    public function updatedFile()
    {
        $this->validate();

        if ($this->file) {
            $this->fileUrl = $this->file->temporaryUrl();
            $this->fileType = $this->file->getClientOriginalExtension();
        }
    }

    public function render(){
        return view('livewire.mgs');

    }

}
