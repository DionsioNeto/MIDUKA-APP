<div>

    @if ($modalImg)
    <div class="modalAccount criar" id="modal-video">
        <button wire:click='togleModalImg'>abrir IMG</button>
        <h1>PDF</h1>
    </div>
    @endif

    @if ($modalAudio)
    <div class="modalAccount criar" id="modal-video">
        <button wire:click='togleModalAudio'>abrir audio</button>
        <h1>Audio</h1>
    </div>
    @endif

    @if ($modalPdf)
    <div class="modalAccount criar" id="modal-video">
        <div class="contentModal">
            <button wire:click='togleModalPdf'>abrir PDF</button>
            <h1>PDF</h1>
        </div>
    </div>
    @endif

    @if ($modalVideo)
    <div class="modalAccount" id="modal-video">

        <div class="contentModal">
            <button wire:click='togleModalVideo'>abrir Video</button>

            <div class="cima">
                @if(session('msg'))
                <div>
                    <div class="modalAccount">
                        <div class="contentModal">
                            <i class="fa fa-check"></i>
                            {{ session('msg') }}
                            </div>
                        </div>
                    </div>
                @endif
                @if(session('Erro'))
                    {{ session('Erro') }}
                @endif
                <h1>Criar conteúdos</h1>
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
                        <small>(jpg, jpeg, png, bmp, tiff, webp, mp4, mp3, pdf.)</small>
                        <input type="file" id="content" wire:model='file'>
                    </div>
                </div>

                {{-- Exibir pré-visualização dependendo do tipo de arquivo --}}
                @if ($fileUrl)
                <div>
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
                </div>
                @endif

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
                    <textarea wire:model='description'></textarea>
                </div>
                <button type="submit">Cancelar</button>
                <button type="submit">Adicionar</button>
            </form>

        </div>

    </div>
    @endif

    <main>
    <button wire:click='togleModalVideo'>abrir Video</button>
    <button wire:click='togleModalImg'>abrir IMG</button>
    <button wire:click='togleModalAudio'>abrir audio</button>
    <button wire:click='togleModalPdf'>abrir PDF</button>

    <div wire:offline>
        <livewire:all-pages />
    </div>
</main>
</div>
