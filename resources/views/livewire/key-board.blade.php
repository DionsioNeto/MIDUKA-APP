{{-- <div>
    <div>
        <h3>Copiar Dados para o Clipboard</h3>
        <hr>
        <!-- Exibe os dados a serem copiados -->
        <p id="clipboardContent">{{ $dataToCopy }}</p>
        <hr>
        <!-- Botão para preparar os dados e copiar para o clipboard -->
        <button wire:click="prepareData" class="btn btn-warning mt-3">
            Preparar Dados
        </button>
        <hr>
        <button id="copyButton" class="btn btn-primary mt-3">
            Copiar para o Clipboard
        </button>

        <h1 id="copid"></h1>

        <script>
            // Função que copia o conteúdo para o clipboard
            document.getElementById('copyButton').addEventListener('click', function() {
                // Obter o conteúdo para copiar
                var content = document.getElementById('clipboardContent').innerText;

                // Criar um elemento temporário de input para copiar o texto
                var tempInput = document.createElement('input');
                tempInput.value = content;
                document.body.appendChild(tempInput);

                // Selecionar o conteúdo e copiar para o clipboard
                tempInput.select();
                document.execCommand('copy');

                // Remover o elemento temporário
                document.body.removeChild(tempInput);

                document.getElementById('copid').innerText="Copiado"
                // Opcional: alertar que o conteúdo foi copiado
                // alert('Dados copiados para o clipboard!');
            });
        </script>
        <style>
        </style>
    </div>

</div> --}}


<div>
    <form wire:submit.prevent='s' method="post">
        <input type="text" placeholder="digite" wire:model='ff'>
        <input type="submit" value="go">
    </form>
</div>
