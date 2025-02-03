@extends('layouts.principal')
@section('title', 'Mi | Support')
@session('content')
@section('css')

@endsession
<livewire:header />
<livewire:sidbar />
<livewire:sidbar-right />
<main>
   <livewire:suppor-inside />
</main>
