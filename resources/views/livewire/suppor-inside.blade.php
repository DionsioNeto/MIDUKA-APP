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
        <div  class="error-org">
            <div class="error-inside">
            @error('email')
                ({{ $message }})
            @enderror
            </div>
            <div class="error-inside">
            @error('description')
                ({{ $message }})
            @enderror
            </div>
            <div class="error-inside">
            @error('phoneNumber')
                ({{ $message }})
            @enderror
            </div>
            <div class="error-inside">
            @error('typeProblem')
                ({{ $message }})
            @enderror
            </div>
        </div>
        <section id="contacto">
            <form wire:submit.prevent='store' method="post">
                <div class="grid">
                    <div class="o" >
                        <input type="text" id="nome"  wire:model='typeProblem'>
                        <label>Tipo de problema</label>
                    </div>
                    <div class="o" >
                        <input type="email" wire:model='email' >
                        <label>Email</label>
                    </div>
                    <div class="o" >
                        <input type="text" id="sms" >
                        <label>Assunto</label>
                    </div>
                    <div class="o" >
                        <input type="text"  wire:model='phoneNumber'>
                        <label>Número de telefone</label>
                    </div>
                </div>
                <div class="o" >
                    <textarea wire:model='description' ></textarea>
                    <label>Descrição</label>
                </div>
                <input type="submit" value="Enviar">
            </form>
        </section>
        <div wire:offline>
            <livewire:all-pages />
        </div>
    </main>
</div>