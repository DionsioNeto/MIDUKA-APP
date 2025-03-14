<div>
    <h1>Pesquisa</h1>
    <div class="content-search-input">
        <button wire:click='openKeyBoard'>
            <i class="fa fa-keyboard"></i>
        </button>

        <form action="/Pesquisar" method="get" class="search">
            @csrf
            <input type="text" wire:model.live="search" placeholder="Pesquisar usuário..." />
            <button>
                <i class="fa fa-search"></i>
            </button>
        </form>
    </div>

    @if ($search)
    <p>Resultados de suas pesquisas: {{ $search }}</p>
    <hr>
    <h3>Contúdos:</h3>
    @foreach ($content as $item)

    <div class="card-content">
        <div>
            <img src="{{ url("storage/uploads/{$item->capa}") }}"  class="card-content-img" alt="">
        </div>
        <div>
            {{ strlen($item->description) > 100 ? substr($item->description, 0, 120) . ' ver mais ...' : $item->description }}
            <hr>
            {{ date('d/m/Y', strtotime($item->created_at)) }} |
            {{ date(' H', strtotime($item->created_at)) }} H {{ date('m', strtotime($item->created_at)) }} M
        </div>
    </div>

    @endforeach

    <h3>Usuários:</h3>

    @foreach ($users as $item)
    <a href="/usuario{{ $item->id }}">
        <div class="card-user">
            <div>
                <div class="img">
                    <img src="{{ $item->profile_photo_url}}" alt="">
                </div>
                <div class="description">
                    <h4>{{ $item->name }}</h4>
                    <p><span>@</span>{{ $item->user_name }} </p>
                </div>
            </div>

            <label for="opc">
                <div class="opc">
                    <details>
                        <summary id="opc">
                            <i class="fa-solid fa-ellipsis"></i>
                        </summary>
                        <ul>
                            <li>
                                <i class="fa fa-mega-phone"></i>
                                Denunciar
                            </li>
                            <li>
                                <i class="fa fa-link"></i>
                                Cópiar URL
                            </li>
                            <li>
                                <i class="fa-regular fa-bookmark"></i>
                                Guardar para ler mais tarde
                            </li>
                            <li>
                                <i class="fa fa-bug"></i>
                                Notificar possível erro
                            </li>
                        </ul>
                    </details>
                </div>
            </label>
        </div>
    </a>
    @endforeach
    @else
    <div class="alert-content">
        <i class="fa-solid fa-circle-exclamation"></i>
        <h1>Sem pesquisa</h1>
        <p>Comece a escrever no input acima para obter dados de pesquisa</p>
    </div>
    @endif
</div>
