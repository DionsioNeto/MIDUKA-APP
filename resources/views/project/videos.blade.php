@extends('layouts.principal')
@section('title', 'Mi | Vídeos')
@session('content')
@endsession
<livewire:header />
<livewire:sidbar />
<livewire:sidbar-right />
<livewire:responsive-nav />
<livewire:videos />
<div wire:offline>
    <livewire:all-pages />
</div>