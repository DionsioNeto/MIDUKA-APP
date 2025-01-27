<div>
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}
    <div>
        <form wire:submit.prevent="submit">
            <!-- Input de arquivo -->
            <input type="file" wire:model="file" />

            <!-- Exibir pré-visualização dependendo do tipo de arquivo -->
            @if ($fileUrl)
                <div class="mt-4">
                    <p><strong>Pré-visualização:</strong></p>

                    <!-- Vídeo (mp4) -->
                    @if (in_array($fileType, ['mp4', 'avi', 'mov', 'mkv']))
                        <video src="{{ $fileUrl }}" controls class="w-64 h-64">
                            Seu navegador não suporta a visualização de vídeos.
                        </video>

                    <!-- Áudio (mp3) -->
                    @elseif (in_array($fileType, ['mp3', 'wav', 'ogg']))
                        <audio src="{{ $fileUrl }}" controls class="w-64 h-64">
                            Seu navegador não suporta a visualização de áudio.
                        </audio>

                    <!-- Imagem (jpg, jpeg, png, etc.) -->
                    @elseif (in_array($fileType, ['jpg', 'jpeg', 'png', 'bmp', 'tiff', 'webp']))
                        <img src="{{ $fileUrl }}" alt="Imagem de pré-visualização" class="w-64 h-64 object-cover">

                    <!-- PDF -->
                    @elseif (in_array($fileType, ['pdf']))
                        <iframe src="{{ $fileUrl }}" class="w-64 h-64" style="border: none;"></iframe>

                    @else
                        <p>Formato não suportado para pré-visualização.</p>
                    @endif
                </div>
            @endif

            <!-- Botão de submit -->
            <button type="submit" class="mt-4 bg-blue-500 text-white py-2 px-4 rounded">Enviar</button>
        </form>
    </div>

</div>
