@extends('layouts.principal')
@section('title', 'Mi | '. Auth::user()->name )
@session('content')

@endsession
<livewire:header />
<livewire:sidbar />
<livewire:sidbar-right />

<main>
    <livewire:profile />
</main>
