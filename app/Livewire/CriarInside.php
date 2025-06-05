<?php
namespace App\Livewire;
use Livewire\Component;
use App\Models\Conteudo;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Livewire\Attributes\Lazy;
// #[Lazy]


class CriarInside extends Component {
    use WithFileUploads;

    public $file;
    public $fileUrl;
    public $fileType;
    public $capa;
    public $description;

    // Para abrir o modal do video
    public $modalVideo = false;

    public function togleModalVideo(){
        $this->modalVideo = !$this->modalVideo;
    }

    // Para abrir o modal img

    public $modalImg = false;

    public function togleModalImg(){
        $this->modalImg = !$this->modalImg;
    }

    // Para abrir o modal audio

    public $modalAudio = false;

    public function togleModalAudio(){
        $this->modalAudio = !$this->modalAudio;
    }

    
    // Para abrir o modal pdf
    public $modalPdf = false;

    public function togleModalPdf(){
        $this->modalPdf = !$this->modalPdf;
    }

    public function storePdf(){
        $cont = new Conteudo();
        $this->validate([
            'description' => 'required|string',
            'capa' => 'required|file',
            'file' => 'required|file',
        ]);

        $cont->description = $this->description;
        $cont->user_id = auth()->user()->id;

        $capa = $this->capa;
        $extension = $capa->extension();
        $CapaName = md5($capa->getClientOriginalName() . strtotime('now')).".".$extension;
        $cont->capa = $CapaName;
        // Armazenar o arquivo de capa no diretório 'uploads'
        $this->capa->storeAs('uploads', $CapaName, 'public');

        //Upload do arquivo no diretório 'uploads'
        $content = $this->file;
        $contentExtension = $content->extension();
        $contentName = md5($content->getClientOriginalName() . strtotime('now')).".".$contentExtension;
        $this->file->storeAs('uploads', $contentName, 'public');
        $cont->content = $contentName;

        $cont->type_tag = $contentExtension;

        $this->capa->storeAs('uploads', $CapaName, 'public');

        if($cont->save()){
            $this->capa = $this->description = $this->file = null;
            session()->flash('msg', 'Sucesso na criação do seu conteúdo');
        }else{
            session()->flash('Erro', 'Sem Sucesso na criação do seu conteúdo, Faça refresh na página e tente novammente');
        }
    }



 

    protected $rules = [
        'file' => 'required|mimes:jpg,jpeg,png,bmp,tiff,webp,mp4,mp3,pdf|max:50240', // Permitindo diferentes tipos de arquivos
        'capa' => 'required|mimes:jpg,jpeg,png,bmp,tiff,webp|max:20240',
        'description' => 'required|min:3',
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
        $cont->capa = $CapaName;
        // Armazenar o arquivo de capa no diretório 'uploads'
        $this->capa->storeAs('uploads', $CapaName, 'public');


        //Upload do arquivo no diretório 'uploads'
        $content = $this->file;
        $contentExtension = $content->extension();
        $contentName = md5($content->getClientOriginalName() . strtotime('now')).".".$contentExtension;
        $this->file->storeAs('uploads', $contentName, 'public');
        $cont->content = $contentName;

        $cont->type_tag = $contentExtension;

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
