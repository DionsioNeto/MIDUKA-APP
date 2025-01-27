<div>
    <h1>Vídeos</h1>
    <div class="grid">
        @foreach ($conteudos as $item)
        <div class="card-video">
            <div class="user-description">
                <a href="/usuario" class="inline">
                    <div class="img-photo">
                        <img src="./imgs/avatar.webp">
                    </div>
                    <div class="page-name">

                        <br>
                        <small>@dionisio.miduka</small>
                    </div>
                </a>
                <div>
                    <div class="foll">
                        Seguir
                    </div>
                    <div class="opc">
                        <i class="fa-solid fa-ellipsis-vertical"></i>
                    </div>
                </div>
            </div>
            <video src="./uploads/"></video>
            <div class="date">
                <i class="fa fa-calendar"></i>

            </div>
            <a href="/ver">
                <div class="description">

                </div>
            </a>
            <div class="comment">
                <div class="c-img">
                    @guest
                    <img src="./imgs/avatar.webp" alt="">
                    @endguest
                    @auth
                    <img src="{{-- Auth::user()->profile_photo_url --}}" alt="{{-- Auth::user()->name --}}">
                    @endauth
                </div>
                <form action="" method="post">
                    <input type="text" placeholder="Digite seu comentário">
                    <button>
                        <i class="fa-solid fa-arrow-right-long"></i>
                    </button>
                </form>
            </div>
            <div class="options">
                <a href="#" wire:click.prevent="unlike()">
                    <i class="fa fa-thumbs-up"></i>
                    <div class="contador">8M</div>
                </a>
                <a href="#" wire:click.prevent="like()">
                    <i class="fa-regular fa-thumbs-up"></i>
                    <div class="contador">8M</div>
                </a>
                <a href="/login">
                    <i class="fa-regular fa-thumbs-up"></i>
                    <div class="contador">8M</div>
                </a>

                <a href="#">
                    <i class="fa-regular fa-comments"></i>
                    <div class="contador">1K</div>
                </a>
                <a href="./uploads/" download>
                    <i class="fa fa-download"></i>
                </a>
                <a href="#">
                    <i class="fa fa-share-nodes"></i>
                </a>
            </div>
        </div>
        @endforeach

    </div>
</div>
