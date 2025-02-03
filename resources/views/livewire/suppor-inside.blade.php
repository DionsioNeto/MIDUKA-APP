<div>
    <h1>Support do usuário</h1>
    <h2>Contrato</h2>
    <form  wire:submit.prevent='store' method="post">
        @csrf
        <input type="text" wire:model='email'>
        <input type="text" wire:model='description'>
        <input type="text" wire:mode='phoneNumber'>
        <input type="text" wire:model='typeProblem'>
        <input type="submit" value="enviar">
    </form>
</div>
