@extends('layouts.principal')
@section('title', 'Mi | Imagens')
@session('content')

@endsession
<livewire:header />
<livewire:sidbar />
<livewire:sidbar-right />
<livewire:responsive-nav />
<main>
    <livewire:imagens />
    <div wire:offline>
        <livewire:all-pages />
    </div>
</main>





