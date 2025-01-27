@extends('layouts.principal')
@section('title', 'Mi | Livros & PDFs')
@session('content')

@endsession
<livewire:header />
<livewire:sidbar />
<main>
    <livewire:livros lazy/>
</main>

