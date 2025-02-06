@extends('layouts.principal')
@section('title', 'Mi | Perfil')
@session('content')

@endsession
<livewire:header />
<livewire:sidbar />
<livewire:sidbar-right />
<livewire:responsive-nav />
<main>
    <livewire:usuario />
    <div wire:offline>
        <livewire:all-pages />
    </div>
</main>
