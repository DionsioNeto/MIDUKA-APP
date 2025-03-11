<div>
    <div>

        @if(session('msg'))
        <div class="modalAccount">
            <div class="contentModal">
                <i class="fa-solid fa-triangle-exclamation"></i>
                <br>
                {{ session('msg') }}
                <div>
                    <a href="/">Voltar a página inicial</a>
                </div>
            </div>
        </div>
        @endif

        @if(session('Erro'))
        <div class="modalAccount">
            <div class="contentModal">
                <i class="fa-solid fa-triangle-exclamation"></i><br>
                {{ session('Erro') }}
                <div>
                    <a href="/">Voltar a página inicial</a>
                </div>
            </div>
        </div>
        @endif

    </div>
    <main>
        <h1>Support do usuário</h1>
        <br>
        <hr>
        <form  wire:submit.prevent='store' method="post">
            @csrf
            <div class="grid">
                <div class="grid-insid">
                    <label for="email">
                        Digite seu e-mail
                        @error('email')
                        (
                            {{ $message }}
                        )
                        @enderror
                    </label>
                    <input id="email" type="text" wire:model='email' placeholder="E-mail" class="btn-simple">
                </div>
                <div class="grid-insid">
                    <label for="description">
                        Digite uma descrição
                        @error('description')
                        (
                            {{ $message }}
                        )
                        @enderror
                    </label>
                    <input id="description" type="text" wire:model='description' placeholder="Descrição" class="btn-simple">
                </div>
                <div class="grid-insid">
                    <label for="tel">
                        Digite o número de telefone
                        @error('tel')
                        (
                            {{ $message }}
                        )
                        @enderror
                    </label>
                    <input id="tel" type="text" wire:mode='tel' placeholder="Telefone" class="btn-simple">
                </div>
                <div class="grid-insid">
                    <label for="typeProblem">
                        Digite o tipo de problema
                        @error('typeProblem')
                        (
                            {{ $message }}
                        )
                        @enderror
                    </label>
                    <input id="typeProblem" type="text" wire:model='typeProblem' placeholder="Tipo de problema" class="btn-simple">
                </div>

                <div class="grid-insid">
                    <button type="submit" class="btn-submit-simple">
                        Enviar
                        <i class="fa-solid fa-arrow-right-long"></i>
                    </button>
                </div>

            </div>
        </form>

        <div wire:offline>
            <livewire:all-pages />
        </div>
    </main>
</div>
