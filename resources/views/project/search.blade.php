@extends('layouts.principal')
@section('title', 'Mi | Principal')
@session('content')
@endsession
<livewire:header />
<livewire:sidbar />
<livewire:sidbar-right />
<livewire:responsive-nav />

<main>
    <livewire:search />

    <div wire:offline>
        <livewire:all-pages />
    </div>
</main>
