<div>
    <div id="modal-video">
        <div class="cima">
            @if(session('msg'))
                {{ session('msg') }}
            @endif
            @if(session('Erro'))
                {{ session('Erro') }}
            @endif
            <h1>Criar</h1>
            <p>Aqui os seus tu podes criar os seus conteúdos.</p>
        </div>
        <div class="steps">
            <div class="boll">1</div>
            <div class="bar">
                <div class="progress"></div>
            </div>
            <div class="boll">2</div>
            <div class="bar"></div>
            <div class="boll">3</div>
        </div>


        <div>
            <h3>Adicione a capa do seu conteúdo</h3>
            <small>(mp4, mp3, png, jpg, JPEG, webp, svg.)</small>
            <div class="danger">
                @error('content')
                    {{ $message }}
                @enderror
            </div>
            <label for="content">
                <div class="recept">
                    <i class="fa-solid fa-cloud-arrow-up"></i>
                    <p>Arraste e solte ou <a href="#">escolha um arquivo para fazer upload</a></p>
                    <p>MP4 / MP3</p>
                </div>
            </label>
        </div>

        <!-- Exibir pré-visualização dependendo do tipo de arquivo -->
        @if ($fileUrl)
        <div class="mt-4">
            <p><strong>Pré-visualização:</strong></p>

            <!-- Vídeo (mp4) -->
            @if (in_array($fileType, ['mp4', 'avi', 'mov', 'mkv']))
                <video src="{{ $fileUrl }}" controls width="50%">
                    Seu navegador não suporta a visualização de vídeos.
                </video>

            <!-- Áudio (mp3) -->
            @elseif (in_array($fileType, ['mp3', 'wav', 'ogg']))
                <audio src="{{ $fileUrl }}" controls width="50%">
                    Seu navegador não suporta a visualização de áudio.
                </audio>

            <!-- Imagem (jpg, jpeg, png, etc.) -->
            @elseif (in_array($fileType, ['jpg', 'jpeg', 'png', 'bmp', 'tiff', 'webp']))
                <img src="{{ $fileUrl }}" alt="Imagem de pré-visualização" width="50%">

            <!-- PDF -->
            @elseif (in_array($fileType, ['pdf']))
                <iframe src="{{ $fileUrl }}" width="50%"></iframe>

            @else
                <p>Formato não suportado para pré-visualização.</p>
            @endif
        </div>
        @endif






<hr>



        <div>
            <h3>Adicione aqui o seu conteúdo</h3>
            <small>(png, jpg, JPEG, webp, svg.)</small>
            <div class="danger">
                @error('capa')
                    {{ $message }}
                @enderror
            </div>
            <div class="recept">
                <i class="fa-solid fa-cloud-arrow-up"></i>
                <p>Arraste e solte ou <a href="#">escolha um arquivo para fazer upload</a></p>
                <p>MP4 / MP3</p>
            </div>
        </div>

        @if ($capa)
            <h4>Pré-visualizar</h4>
            <img src="{{ $capa->temporaryUrl() }}" />
        @endif
<hr>
        <form wire:submit.prevent='store' method="post" enctype="multipart/form-data">
            @csrf

            <input type="file" id="content" wire:model='file'>

            <input type="file" id="" wire:model='capa'>

            <div>
                <h3>Adicione aqui a descrição completa</h3>
                <div class="danger">
                    @error('description')
                        {{ $message }}
                    @enderror
                </div>
                <textarea wire:model='description'></textarea>
            </div>
            <button type="submit">Adicionar</button>
        </form>
        <div class="btns">
            <div>
                <a href="">
                    <i class="fa fa-circle-exclamation"></i>
                </a>
                <a href="">
                    <i class="fa-solid fa-headset"></i>
                </a>
            </div>
        </div>
    </div>
</div>
