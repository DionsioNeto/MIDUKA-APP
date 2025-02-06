@extends('layouts.principal')
@section('title', 'Mi | '. Auth::user()->name )
@session('content')

@endsession
<livewire:header />
<livewire:sidbar />
<livewire:sidbar-right />
<livewire:responsive-nav />

<main>
    <livewire:profile />
    <div wire:offline>
        <livewire:all-pages />
    </div>
</main>
