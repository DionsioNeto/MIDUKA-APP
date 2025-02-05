@extends('layouts.principal')
@section('title', 'Mi | Livros & PDFs')
@session('content')

@endsession
<livewire:header />
<livewire:sidbar />
<livewire:responsive-nav />
<main>
    <livewire:livros />
</main>

