<div>
    <h3>Upload de Arquivos</h3>

    <!-- Exibe mensagens de sucesso ou erro -->
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <!-- Formulário de Upload -->
    <div>
        <input type="file" wire:model="files" multiple>
        @error('files.*') 
        <span class="text-danger">
        {{ $message }}
        </span> 
        @enderror
    </div>

    <!-- Previews dos Arquivos -->
    <div class="mt-3">
        @foreach($preview as $url)
            <div class="preview">
                <img src="{{ $url }}" alt="Preview" style="max-width: 100px; margin-right: 10px;">
            </div>
        @endforeach
    </div>

    <!-- Botão para Salvar os Arquivos -->
    <button wire:click="save" class="btn btn-primary mt-3">Salvar Arquivos</button>
</div>