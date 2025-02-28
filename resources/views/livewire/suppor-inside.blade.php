<div>
    <h1>Support do usuário</h1>
    <h2>Contrato</h2>
    <div>
        @if(session('msg'))
                {{ session('msg') }}
        @endif
        @if(session('Erro'))
            {{ session('Erro') }}
        @endif
    </div>
    <form  wire:submit.prevent='store' method="post">
        @csrf
        @error('email')
            {{ $message }}
        @enderror
        <input type="text" wire:model='email' placeholder="emil">
        @error('description')
            {{ $message }}
        @enderror
        <input type="text" wire:model='description' placeholder="descrição">
        @error('tel')
            {{ $message }}
        @enderror
        <input type="text" wire:mode='tel' placeholder="Telefone">
        @error('typeProblem')
            {{ $message }}
        @enderror
        <input type="text" wire:model='typeProblem' placeholder="Tipo de problema">
        <input type="submit" value="enviar">
    </form>
</div>
