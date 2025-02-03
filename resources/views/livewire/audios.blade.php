<div>
    <h1>Audios</h1>
    @if (count($conteudos) > 0)
        @foreach ($conteudos as $item)
            <h2>test</h2>
        @endforeach
    @else
    <livewire:content />
    @endif
</div>
