@extends('layouts.principal')
@section('title', 'Mi | Vídeos')
@session('content')

@endsession
<livewire:header />
<livewire:sidbar />
<livewire:responsive-nav />
<main>
    <livewire:videos />
</main>





