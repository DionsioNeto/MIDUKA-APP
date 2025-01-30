{{--

<div class="card-upload">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <style>

.card-upload{
    position: relative;
width: 400px;
padding: 8px;
height: 320px;
    background: red;
    border-radius: 0.5rem;
    overflow: hidden
}

.card-upload input{
    display: flex;
    background: black;
    width: 100%;
    height: 100%;
    appearance: none;
    opacity: 0;
}
.icon{
    background: green;
    position: absolute;
    top:0;
    left: 0;
    width: 100%;
    height: 100%;

    display: flex;
    justify-content: center;
    align-items: center;
flex-direction: column;

}


    </style>




<div class="icon">
    <i class="fa fa-upload"></i>
    <p>arraste aqui os teus arquivos</p>
</div>

<input type="file">


</div>



 livewire --}}

{{-- // config/filesystem.php

// 'public' => [
//     'driver' => 'local',
//     'root' => storage_path('app/public'),
//     'url' => env('APP_URL') . '/storage',
//     'visibility' => 'public',
// ],


// php artisan storage:link
// npm install && npm run dev
// php artisan serve --}}
@livewireStyles
@stack('styles')

<div class="keyboard-container">
    <div class="input-area">
        <input type="text" wire:model="inputText" readonly class="input-text">
        <button wire:click="toggleKeyboard" class="btn-toggle-keyboard">
            {{ $isKeyboardVisible ? 'Fechar Teclado' : 'Abrir Teclado' }}
        </button>
    </div>

    @if($isKeyboardVisible)
        <div id="keyboard" class="keyboard" draggable="true" ondragstart="startDrag(event)">
            <div class="keyboard-row">
                @foreach(range('a', 'z') as $letter)
                    <button wire:click="addCharacter('{{ $letter }}')" class="key">{{ $letter }}</button>
                @endforeach
                <button wire:click="addCharacter(' ')" class="key">Space</button>
                <button wire:click="removeCharacter()" class="key">Backspace</button>
            </div>
        </div>
    @endif
</div>

@push('styles')
    <style>
        .keyboard-container {
            position: relative;
            margin-top: 20px;
            text-align: center;
        }
        .input-area {
            margin-bottom: 20px;
        }
        .input-text {
            width: 300px;
            padding: 10px;
            font-size: 18px;
            text-align: center;
        }
        .btn-toggle-keyboard {
            padding: 10px;
            font-size: 16px;
            cursor: pointer;
        }
        .keyboard {
            display: flex;
            flex-wrap: wrap;
            max-width: 360px;
            margin: 20px auto;
            border: 1px solid #ccc;
            padding: 10px;
            background-color: #f4f4f4;
            border-radius: 5px;
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
        }
        .keyboard-row {
            display: flex;
            flex-wrap: wrap;
        }
        .key {
            padding: 10px;
            margin: 5px;
            font-size: 16px;
            cursor: pointer;
            background-color: #ddd;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .key:hover {
            background-color: #ccc;
        }
    </style>
@endpush

@push('scripts')
    <script>
        function startDrag(event) {
            event.dataTransfer.setData("text", event.target.id);
        }

        const keyboard = document.querySelector("#keyboard");

        keyboard.addEventListener("drag", function(e) {
            e.preventDefault();
            const mouseX = e.clientX;
            const mouseY = e.clientY;

            // Movimentar o teclado com o mouse
            keyboard.style.left = `${mouseX - keyboard.offsetWidth / 2}px`;
            keyboard.style.top = `${mouseY - keyboard.offsetHeight / 2}px`;
        });
    </script>
@endpush
@livewireScripts
@stack('scripts')
