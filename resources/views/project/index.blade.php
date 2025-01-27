@extends('layouts.principal')
@section('title', 'Mi | Principal')
@session('content')
@endsession
<livewire:header lazy/>
<livewire:sidbar lazy/>
<livewire:sidbar-right lazy/>
<livewire:responsive-nav />
<main>
    <livewire:content lazy/>
</main>
