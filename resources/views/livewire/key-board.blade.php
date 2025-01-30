

<div class="card-upload">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <style>

.card-upload{
    position: relative;
width: 400px;
padding: 8px;
height: 320px;
    background: red;
    border-radius: 0.5rem;
    overflow: hidden
}

.card-upload input{
    display: flex;
    background: black;
    width: 100%;
    height: 100%;
    appearance: none;
    opacity: 0;
}
.icon{
    background: green;
    position: absolute;
    top:0;
    left: 0;
    width: 100%;
    height: 100%;

    display: flex;
    justify-content: center;
    align-items: center;
flex-direction: column;

}


    </style>




<div class="icon">
    <i class="fa fa-upload"></i>
    <p>arraste aqui os teus arquivos</p>
</div>

<input type="file">


</div>
 livewire <?php
 namespace App\Http\Livewire;

 use Livewire\Component;
 use Livewire\WithFileUploads;
 use Illuminate\Support\Facades\Storage;

 class UploadComponent extends Component
 {
     use WithFileUploads;

     public $file1;
     public $file2;
     public $text;

     public function upload()
     {
         $this->validate([
             'file1' => 'required|file|max:2048', // Max 2MB
             'file2' => 'required|file|max:2048',
             'text' => 'required|string|max:255',
         ]);

         $path1 = $this->file1->store('uploads', 'public');
         $path2 = $this->file2->store('uploads', 'public');

         session()->flash('message', 'Upload realizado com sucesso!');

         // Salva paths e texto para futuro uso, exemplo
         info("File 1: {$path1}, File 2: {$path2}, Text: {$this->text}");

         // Limpa os dados após upload
         $this->reset(['file1', 'file2', 'text']);
     }

     public function render()
     {
         return view('livewire.upload-component');
     }
 }


 blade

 <div class="p-6">
    @if (session()->has('message'))
        <div class="bg-green-100 text-green-700 p-2 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="upload" enctype="multipart/form-data">
        <div class="mb-4">
            <label for="file1" class="block text-sm font-medium">Escolha o primeiro arquivo:</label>
            <input type="file" id="file1" wire:model="file1" class="mt-2">
            @error('file1') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror

            @if ($file1)
                <p class="mt-2 text-sm">Pré-visualização:</p>
                <img src="{{ $file1->temporaryUrl() }}" class="w-32 h-32 object-cover mt-2">
            @endif
        </div>

        <div class="mb-4">
            <label for="file2" class="block text-sm font-medium">Escolha o segundo arquivo:</label>
            <input type="file" id="file2" wire:model="file2" class="mt-2">
            @error('file2') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror

            @if ($file2)
                <p class="mt-2 text-sm">Pré-visualização:</p>
                <img src="{{ $file2->temporaryUrl() }}" class="w-32 h-32 object-cover mt-2">
            @endif
        </div>

        <div class="mb-4">
            <label for="text" class="block text-sm font-medium">Texto:</label>
            <input type="text" id="text" wire:model="text" class="mt-2 p-2 border rounded w-full">
            @error('text') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="bg-blue-600 text-white p-2 rounded">Fazer Upload</button>
    </form>
</div>


config/filesystem.php

'public' => [
    'driver' => 'local',
    'root' => storage_path('app/public'),
    'url' => env('APP_URL') . '/storage',
    'visibility' => 'public',
],


php artisan storage:link
npm install && npm run dev
php artisan serve
