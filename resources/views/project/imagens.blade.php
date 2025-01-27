@extends('layouts.principal')
@section('title', 'Mi | Imagens')
@session('content')

@endsession
<livewire:header />
<livewire:sidbar />
<main>
    <livewire:imagens lazy/>
</main>





