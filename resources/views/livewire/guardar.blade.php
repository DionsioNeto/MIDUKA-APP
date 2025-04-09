<div class="relactive">
    <h1>Conteúdos guardados</h1>
    @if (count($item) > 0)
    <div class="container-grid">
        @foreach ($item as $itens)
        <div class="box-inside">
            <a href="/usuario{{ $itens->conteudo->user->id }}">
                <div class="top">
                    <h3>
                        {{ strlen($itens->conteudo->user->name) > 20 ? substr($itens->conteudo->user->name, 0, 20) . ' ...' : $itens->conteudo->user->name }}
                    </h3>
                    <div>
                        <small>{{ date('d/m/Y', strtotime($itens->conteudo->created_at)) }}</small>
                        <i class="fa-regular fa-bookmark"></i>
                    </div>
                </div>
            </a>
            <a href="/ver{{$itens->conteudo->id}}">
                <div class="img">
                    <img src="{{ url("storage/uploads/{$itens->conteudo->capa}") }}" class="capa">
                </div>
            </a>
            <div class="down">
                <div>
                    {{ strlen($itens->conteudo->description) > 80 ? substr($itens->conteudo->description, 0, 80) . ' ...' : $itens->conteudo->description }}
                </div>
                <details>
                    <summary>
                        <div class="opc">
                            <i class="fa-solid fa-ellipsis"></i>
                        </div>
                    </summary>
                    <ul>
                        <li>
                            <i class="fa fa-mega-phone"></i>
                            Denunciar
                        </li>
                        <a wire:click.prevent="unguard({{ $itens->conteudo->user->id }})">
                            <li>
                                <i class="fa-solid fa-bookmark"></i>
                                Não guardar para mais tarde
                            </li>
                        </a>
                        <li>
                            <i class="fa-regular fa-bell"></i>
                            Notificar-me
                        </li>
                        <li>
                            <i class="fa fa-link"></i>
                            Cópiar link
                        </li>

                        <li>
                            <i class="fa fa-bug"></i>
                            Notificar possível erro
                        </li>
                    </ul>
                </details>
            </div>
        </div>
        @endforeach
    </div>
       
    @else
    <livewire:no-content />
    @endif
    <div wire:offline>
        <livewire:all-pages />
    </div>
</div>
