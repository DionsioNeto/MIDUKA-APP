<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MI | Conteúdo</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('./styles/ver.css') }}">
</head>
<body>

<div class="media-section">
    <header>
        <div class="logo">
            <a href="/">
                <img src="{{ url("storage/more/logo.png") }}" class="Logo"  title="Logo">
            </a>
        </div>
    </header>
    @if ($item->type_tag == "jpg")
    <img src="{{ url("storage/uploads/{$item->content}") }}">
    @elseif($item->type_tag == "mp4")
    <video src="{{ url("storage/uploads/{$item->content}") }}" controls></video>
    @elseif ($item->type_tag == "mp3")
    <audio src="{{ url("storage/uploads/{$item->content}") }}"  controls="" autoplay=""></audio>
    @elseif ($item->type_tag == "pdf")
    <iframe src="{{ url("storage/uploads/{$item->content}") }}" frameborder="0"></iframe>
    @endif 
</div>

<div class="post-container">
  <div class="user">
    <a href="/usuario{{ $item->user->id }}">
        <div class="avatar"><img src="{{ $item->user->profile_photo_url }}"></div>
        <div class="user-info">
            <strong>
                    {{$item->user->name }}
            </strong>
            <span class="time">
                {{ date('d/m/Y', strtotime($item->created_at)) }} •
                {{ date(' H', strtotime($item->created_at)) }} H {{ date('m', strtotime($item->created_at)) }}
            </span>
        </div>
    </a>
  </div>

  <div class="post-text">
    {{$item->description}}
  </div>

  <div class="reactions">
    <div>
      <span><i class="fa fa-thumbs-up"></i></span> <span>{{ $item->likes->count() }}</span>
    </div>
    <div>
      <span>{{ $com->count() }} comentários</span> • <span>{{ $com->count() }}compartilhamentos</span>
    </div>
  </div>

  <div class="actions">
    <button>
        {{-- @auth --}}
            @if ($item->Likes->count())
            <a wire:click.prevent="unlike({{ $item->id }})">
                <i class="fa fa-thumbs-up"></i>
            </a>
            @else
            <a wire:click.prevent="like({{ $item->id }})">
                <i class="fa-regular fa-thumbs-up"></i>
            </a>
            @endif
        {{-- @endauth --}}
    </button>
    <button><i class="fa-solid fa-comments"></i></button>
    <button>
        @if ($item->Guardados->count())
            <a wire:click.prevent="unguard({{ $item->id }})">
                <li>
                    <i class="fa-solid fa-bookmark"></i>
                </li>
            </a>
        @else
            <a wire:click.prevent="guard({{ $item->id }})">
                <li>
                    <i class="fa-regular fa-bookmark"></i>
                </li>
            </a>
        @endif
    </button>
  </div>

  <div class="add-comment">
    <div class="avatar" style="width: 32px; height: 32px;">
        @guest
        <a href="/perfil" title="Iniciar sessão">
            <div class="img-photo">
                <img src="./imgs/avatar.webp" alt="">
            </div>
        </a>
        @endguest
        @auth
        <a href="/perfil" title="{{ Auth::user()->name }}">
            <div class="img-photo">
                <img src="{{ Auth::user()->profile_photo_url }}" alt="">
            </div>
        </a>
        @endauth
    </div>
        <form wire:submit.prevent='storageComment'>
            <textarea placeholder="Comentar como {{ Auth::user()->name }}..." wire:model='comment' ></textarea>
            <i class="fa-solid fa-paper-plane"></i>
        </form>
  </div>

  @if ($com->count() < 0)
    @foreach ($com as $item)
    <div class="comment">
      <div class="author">Elíf Epalanga</div>
      <div class="text">{{ $item->content }}</div>
      <div class="time">Just now • Curtir • Responder</div>
    </div>
    @endforeach
  @else
  <div class="comment">
    <h1>Sem comentários</h1>
  </div>
  @endif

  <button wire:click='ss'>oiii</button>

</div>


</body>
</html>