@extends('layouts.principal')
@section('title', 'Mi | Criar conteúdo')
@session('content')

@endsession
<livewire:header />
<livewire:sidbar />
<livewire:sidbar-right />
<livewire:responsive-nav />

<main>
    <livewire:criar-inside />
</main>
