@extends('layouts.principal')
@section('title', 'Mi | Audios')
@session('content')

@endsession
<livewire:header />
<livewire:sidbar />
<livewire:sidbar-right />
<livewire:responsive-nav />
<main>
    <livewire:audios />
    <div wire:offline>
        <livewire:all-pages />
    </div>
</main>





