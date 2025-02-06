<?php
namespace App\Livewire;
use Livewire\Component;
use App\Models\Conteudo;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Lazy;
#[Lazy]


class CriarInside extends Component {
    use WithFileUploads;

    public $file;
    public $fileUrl;
    public $fileType;
    public $capa;
    public $description;

    protected $rules = [
        'file' => 'required|mimes:jpg,jpeg,png,bmp,tiff,webp,mp4,mp3,pdf|max:10240', // Permitindo diferentes tipos de arquivos
        'capa' => 'required|mimes:jpg,jpeg,png,bmp,tiff,webp',
        'description' => 'required|min:20',
    ];

    // Atualizar o arquivo e gerar URL temporária
    public function updatedFile() {
        $this->validateOnly('file'); // Valida somente o campo 'file'
        if ($this->file) {
            $this->fileUrl = $this->file->temporaryUrl();
            $this->fileType = $this->file->getClientOriginalExtension();
        }
    }

    // Validação independente para a capa
    public function updatedCapa() {
        $this->validateOnly('capa'); // Valida somente o campo 'capa'
    }

    public function store(){
        $cont = new Conteudo();
        $this->validate();
        $cont->description = $this->description;
        $cont->user_id = auth()->user()->id;


        //uploads da capa do arquivo

        $capa = $this->capa;
        $extension = $capa->extension();
        $CapaName = md5($capa->getClientOriginalName() . strtotime('now')).".".$extension;
        //$capa->StorageAs::move(public_path('uploads/capas'), $CapaName);
        $cont->capa = $CapaName;


        // Gerar um novo nome para o arquivo
        // $filename = Str::random(10) . '.' . $this->file->getClientOriginalExtension();

        // Armazenar o arquivo no diretório 'uploads'
        $this->capa->storeAs('uploads', $CapaName, 'public');


        //Upload do arquivo
        $content = $this->file;
        $contentExtension = $content->extension();
        $contentName = md5($content->getClientOriginalName() . strtotime('now')).".".$contentExtension;
        // $content->StorageAs::move(public_path('uploads/archives'), $contentName);
        $cont->content = $contentName;

        $cont->type_tag = $contentExtension;
// dd("archive->" .$contentName, "Capa->" . $CapaName);
        $this->capa->storeAs('uploads', $CapaName, 'public');
        if( $cont->save() ){
            $this->capa = $this->description = $this->file = null;
            session()->flash('msg', 'Sucesso na criação do seu conteúdo');
        }else{
            session()->flash('Erro', 'Sem Sucesso na criação do seu conteúdo, Faça refresh na página e tente novammente');
        }
    }

    public function render() {
        return view('livewire.criar-inside');
    }
}
