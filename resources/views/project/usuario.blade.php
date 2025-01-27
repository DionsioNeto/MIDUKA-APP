@extends('layouts.principal')
@section('title', 'Mi | Perfil')
@session('content')

@endsession
<livewire:header />
<livewire:sidbar />
<livewire:sidbar-right />
<main>
    <livewire:usuario />
</main>
