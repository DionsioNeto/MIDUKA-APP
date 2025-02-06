@extends('layouts.principal')
@section('title', 'Mi | Support')
@session('content')
@section('css')

@endsession
<livewire:header />
<livewire:sidbar />
<livewire:sidbar-right />
<livewire:responsive-nav />
<main>
   <livewire:suppor-inside />
   <div wire:offline>
        <livewire:all-pages />
    </div>
</main>
