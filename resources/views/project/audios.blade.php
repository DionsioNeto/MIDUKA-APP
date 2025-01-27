@extends('layouts.principal')
@section('title', 'Mi | Audios')
@session('content')

@endsession
<livewire:header />
<livewire:sidbar />
<main>
    <livewire:audios lazy/>
</main>





