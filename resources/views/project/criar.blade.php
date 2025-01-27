@extends('layouts.principal')
@section('title', 'Mi | Criar conteúdo')
@session('content')

@endsession
<livewire:header lazy/>
<livewire:sidbar lazy/>
<livewire:sidbar-right lazy/>
<livewire:responsive-nav lazy/>

<main>
    <livewire:criar-inside lazy/>
</main>
