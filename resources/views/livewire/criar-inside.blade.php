<div>

    @if(session('msg'))
    <div class="modalAccount" style="z-index: 6;">
        <div class="contentModal">
            <i class="fa fa-check"></i>
            {{ session('msg') }}
            <br>
            <a href="/">Ir para página principal</a>
        </div>
    </div>
    @endif

    @if ($modalImg)
    <div class="modalAccount criar modal-video">
        <button wire:click='togleModalImg'>abrir IMG</button>
        <h1>IMG</h1>
    </div>
    @endif

    @if ($modalAudio)
    <div class="modalAccount criar modal-video">
        <button wire:click='togleModalAudio'>abrir audio</button>
        <h1>Audio</h1>
    </div>
    @endif

    @if ($modalPdf)
    <div class="modalAccount modal-video">
        <div class="contentModal">
            <div class="cima">
                <h1>Adicionar PDF (Livros)</h1>
                <button wire:click='togleModalPdf'>&times;</button>
            </div>
            <form wire:submit.prevent='storePdf' method="post" enctype="multipart/form-data">
                @csrf

                <div>
                    <h3>Reservado para adicionar o PDF (Livro) que pretende postar</h3>
                    <div class="danger">
                    @error('content')
                        {{ $message }}
                    @enderror
                    </div>
                    <div class="recept">
                        <i class="fa-solid fa-cloud-arrow-up"></i>
                        <p>Clique neste campo ou arraste o seu arquivo e solte aqui para começar o upload</p>
                        <small>(PDF.)</small>
                        <input type="file" id="content" wire:model='file'>
                    </div>
                </div>

                <hr>

                <div>
                    <h3>Reservado para adicionar a capa do conteúdo</h3>
                    <div class="danger">
                        @error('capa')
                            {{ $message }}
                        @enderror
                    </div>
                    <div class="recept">
                        <i class="fa-solid fa-cloud-arrow-up"></i>
                        <p>Clique neste campo ou arraste o seu arquivo e solte aqui para começar o upload</p>
                        <small>(jpg, jpeg, png, bmp, tiff, webp.)</small>
                        <input type="file" id="" wire:model='capa'>
                    </div>
                </div>
                @if ($capa)
                    <h4>Pré-visualizar</h4>
                    <img src="{{ $capa->temporaryUrl() }}"  width="50%" />
                @endif
                <hr>
                <div>
                    <h3>Adicione aqui a descrição completa</h3>
                    <div class="danger">
                        @error('description')
                            {{ $message }}
                        @enderror
                    </div>
                    <textarea wire:model='description' placeholder="Fale detalhadamente sobre o livro em questão..."></textarea>
                </div>
                <button type="submit">Adicionar</button>
            </form>
        </div>
    </div>
    @endif

    @if ($modalVideo)
    <div class="modalAccount modal-video">

        <div class="contentModal">
            <div class="cima">
                
                @if(session('Erro'))
                    {{ session('Erro') }}
                @endif
                <h1>Adicionar vídeo</h1>
                <button wire:click='togleModalVideo'>&times;</button>
            </div>

            <form wire:submit.prevent='store' method="post" enctype="multipart/form-data">
                @csrf

                <div>
                    <h3>Reservado para adicionar o conteúdo que pretende postar</h3>
                    <div class="danger">
                    @error('content')
                        {{ $message }}
                    @enderror
                    </div>
                    <div class="recept">
                        <i class="fa-solid fa-cloud-arrow-up"></i>
                        <p>Clique neste campo ou arraste o seu arquivo e solte aqui para começar o upload</p>
                        <small>(MP4.)</small>
                        <input type="file" id="content" wire:model='file'>
                    </div>
                </div>
                
                

                <div class="pag">
                    <div wire:loading wire:target="file" class="center">
                        <img src="{{ url("storage/more/loading.gif") }}" width="50%">
                    </div>
                    @if ($fileUrl)
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
                            <h4>Formato não suportado para pré-visualização.</h4>
                            <div>
                                {{$fileUrl}}
                            </div>
                        @endif
                    @endif
                </div>

                <hr>

                <div>
                    <h3>Reservado para adicionar a capa do conteúdo</h3>
                    <div class="danger">
                        @error('capa')
                            {{ $message }}
                        @enderror
                    </div>
                    <div class="recept">
                        <i class="fa-solid fa-cloud-arrow-up"></i>
                        <p>Clique neste campo ou arraste o seu arquivo e solte aqui para começar o upload</p>
                        <small>(jpg, jpeg, png, bmp, tiff, webp.)</small>
                        <input type="file" id="" wire:model='capa'>
                    </div>
                </div>
                <div wire:loading wire:target="capa" class="center">
                    <img src="{{ url("storage/more/loading.gif") }}" width="50%">
                    <p>A carregar...</p>
                </div>
                @if ($capa)
                    <h4>Pré-visualizar</h4>
                    <img src="{{ $capa->temporaryUrl() }}"  width="50%" />
                @endif
                <hr>
                <div>
                    <h3>Adicione aqui a descrição completa</h3>
                    <div class="danger">
                        @error('description')
                            {{ $message }}
                        @enderror
                    </div>
                    <textarea wire:model='description' placeholder="Detalha a sua descrição"></textarea>
                </div>
                <button type="submit">Adicionar</button>
            </form>

        </div>

    </div>
    @endif

    <main>
        <h1>Criar conteúdos</h1>
        <div class="grid-criar relactive">
            <button class="card" data-modal="modal-video" wire:click='togleModalVideo'>
                <span class="icon">
                    <i class="fa fa-video"></i>
                </span>
                <h2>Vídeo</h2>
                <p>Crie e compartilhe vídeos educativos com facilidade.</p>
              </button>
        
              <button class="card" data-modal="modal-imagem" wire:click='togleModalImg'>
                <span class="icon">
                    <i class="fa fa-images"></i>
                </span>
                <h2>Imagens</h2>
                <p>Adicione gráficos, fotos e ilustrações educativas.</p>
              </button>
        
              <button class="card" data-modal="modal-audio" wire:click='togleModalAudio'>
                <span class="icon">
                    <i class="fa fa-microphone-lines"></i>
                </span>
                <h2>Áudios</h2>
                <p>Grave podcasts, narrações e trilhas sonoras educativas.</p>
              </button>
        
              <button class="card" data-modal="modal-pdf" wire:click='togleModalPdf'>
                <span class="icon">
                    <i class="fa fa-book"></i>
                </span>
                <h2>PDF (Livros)</h2>
                <p>Compartilhe livros e materiais em PDF.</p>
              </button>
            </div>
        <div wire:offline>
            <livewire:all-pages />
        </div>
    </main>
</div>
