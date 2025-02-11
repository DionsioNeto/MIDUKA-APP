@extends('layouts.principal')
@section('title', 'Mi | Livros & PDFs')
@session('content')

@endsession
<livewire:header />
<livewire:sidbar />
<livewire:sidbar-right />
<livewire:responsive-nav />
<main>
    <livewire:livros />
    <div wire:offline>
        <livewire:all-pages />
    </div>
</main>

