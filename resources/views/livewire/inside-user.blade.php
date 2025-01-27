<div>

    <div>
        <h1>Perfil</h1>
        <div class="main-img">
            <img src="{{ $usuario->profile_photo_url }}" alt="{{ $usuario->name }}">
        </div>

        <div class="padding">
            <div class="informacao">
                <div class="profile-photo">
                    <img src="{{ $usuario->profile_photo_url }}" alt="{{ $usuario->name }}">
                </div>
                <div class="nameOPtion">
                    <h2>{{ $usuario->name }}</h2>
                    <a href="" class="op">
                        <i class="fa-solid fa-share"></i>
                    </a>
                </div>
                <small>{{ $usuario->email }}</small>
           </div>
        </div>
        <div class="dados">
            <div class="bio">
                Biográfia😪🧠
            </div>
            <div>
                <i class="fa fa-location"></i>
                Luanda, Angola
            </div>
            <div>
                <i class="fa fa-calendar"></i>
                Aderiu em {{ date('Y' , strtotime($usuario->created_at)) }}
            </div>
            <div class="seguidor">
                <i class="fa-solid fa-handshake-simple"></i> Conexões: 0
            </div>
        </div>

    <hr>

    <section class="posts">
        <h1>Sem posts</h1>
    </section>

    <div class="grid">

</div>
