@extends('layouts.principal')
@section('title', 'Mi | Vídeos')
@session('content')

@endsession
<livewire:header />
<livewire:sidbar />
<main>
    <livewire:videos lazy/>
</main>





