@extends('layouts.principal')
@section('title', 'MI | Notificações')
@section('content')
    <link rel="stylesheet" href="./styles/notification.css">

<livewire:header/>
<livewire:sidbar />
<livewire:responsive-nav />
<main>

    <div class="main">
        <h1>Notificações</h1>
        <div class="container">
            <div class="card-notification">
                <div class="descricao">
                    Uma curtida no seu PDF
                </div>
                <div class="hours">
                    02/12/2024 - 18h 20m
                </div>
            </div>
            <div class="card-notification">
                <div class="descricao">
                    O grupo MIduka da-lhe as boas vindas
                </div>
                <div class="hours">
                    02/12/2024 - 18h 20m
                </div>
            </div>
        </div>
    </div>

</main>


@endsection
