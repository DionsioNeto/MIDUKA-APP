<div>
    {{-- Model excluir conta! --}}
    @if($isModalVisible)
    <div class="modalAccount">
        <div class="contentModal">
            <div class="inside-modal">
                <i class="fa-solid fa-triangle-exclamation"></i>
                <h4>Tem a certeza que pretende excluir a sua conta?</h4>
                <p>Lembrando que se excluir a conta <strong>{{ Auth::user()->name }}</strong> , você perderá alguns previlégios</p>
                <div class="buttons">
                    <div class="btn" wire:click="destroy">Excluir conta</div>
                    <div class="btn" wire:click="toggleModal">Cancelar</div>
                </div>
            </div>
        </div>
    </div>
    @endif
    {{-- Modal de alteração de email --}}
    @if($isProfileEmail)
    <div class="modalAccount">
        <div class="contentModal">
            <div class="inside-modal">
                <i class="fa-solid fa-envelope"></i>
                <h4>Tem a certeza que pretende editar o email de sua conta?</h4>
                <div>
                    <form wire:submit.prevent="updateEmail">
                        @if(session('msg-mail'))
                                <i class="fa-solid fa-check"></i><br>
                                {{ session('msg-mail') }}
                                <div>
                                    <a href="/">Voltar a página inicial</a>
                                </div>
                        @endif
                        @error('email')
                        <span>{{ $message }}</span>
                        @enderror
                        <input type="email" id="email" wire:model="email" placeholder="Digite seu novo e-mail">

                        <button type="submit" class="btn">Atualizar E-mail</button>

                    </form>
                </div>
                <div class="buttons">
                    <div class="btn" wire:click="toggleProfileEmail">Cancelar</div>
                </div>
            </div>
        </div>
    </div>
    @endif
    {{-- Modal da imagens de perfil --}}

    @if($isPlofileImage)
    <div class="modalAccount">
        <div class="contentModal">
            <div class="inside-modal">
                <i class="fa fa-images"></i>
                <form wire:submit.prevent="updatedPhoto">
                    <input type="file" wire:model="photo" id="select" style="display: none;">
                    @error('photo') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </form>
                <h4>Tem a certeza que pretende alterar a sua foto de perfil?</h4>
                @if (session()->has('success'))
                    <div class="">{{ session('success') }}</div>
                @else
                <div>
                    Click na imagem para seleccionar nova foto de perfil.
                </div>
                @endif
                
                <label for="select">
                    <div class="img">
                        <img src="{{ Auth::user()->profile_photo_url }}" alt="">
                        @if ($photoUrl)
                        <div class="mb-4">
                            <img src="{{ $photoUrl }}" alt="Foto de Perfil">
                        </div>
                        @else
                        <div class="mb-4 text-center text-gray-500">
                            Nenhuma foto de perfil.
                        </div>
                        @endif
                    </div>
                </label>
                <div class="buttons">
                    @if (Auth::user()->profile_photo_url)
                    <div class="btn" wire:click="removePhoto">Remover imagem</div>
                    @endif
                    <div class="btn" wire:click="toggleProfileImage">Cancelar</div>
                    
                </div>
            </div>
        </div>
    </div>
    @endif
    {{-- Modal de alteração de palavra-passe --}}
    @if($isPassWord)
    <div class="modalAccount">
        <div class="contentModal">
            <i class="fa-solid fa-lock"></i>
            <h4>Tem a certeza que pretende editar o email de sua conta?</h4>
            @if (session()->has('success'))
                <div class="mb-4 text-green-600">{{ session('success') }}</div>
            @endif
            <div>
                <form wire:submit.prevent="updatePassword">
                    <div class="mb-3">
                        <input type="password" id="current_password" wire:model.defer="current_password" class="form-control" placeholder="Digite sua senha atual">
                        @error('current_password') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <input type="password" id="new_password" wire:model.defer="new_password" class="form-control" placeholder="Digite sua nova senha">
                        @error('new_password') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <input type="password" id="new_password_confirmation" wire:model.defer="new_password_confirmation" class="form-control" placeholder="Confirme sua nova senha">
                        @error('new_password_confirmation') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Atualizar Senha</button>
                </form>
            </div>
            <div class="buttons">
                <div class="btn" wire:click="togglePassWord">Cancelar</div>
            </div>
        </div>
    </div>
    @endif

    @if ($imageProfileCap)
    <div class="modalAccount">
        <div class="contentModal">
            <div class="inside-modal">

                <i class="fa fa-images"></i>

                <form wire:submit.prevent="salvarCapa">
                    <input type="file" wire:model="capa" id="select" style="display: none;">
                    @error('capa') <span class="error">{{ $message }}</span> @enderror

                    <h4>Tem certeza que deseja alterar sua foto de capa?</h4>

                    @if (session()->has('success'))
                        <div class="success">{{ session('success') }}</div>
                    @else
                        <div class="info">Clique na imagem para selecionar uma nova foto de capa.</div>
                    @endif

                    <label for="select" class="img cursor-pointer">
                        @if ($photoUrl)
                            <img src="{{ $photoUrl }}" alt="Nova capa (preview)" class="preview">
                        @elseif (Auth::user()->profile_photo_capa_path)
                            <img src="{{ asset('storage/' . Auth::user()->profile_photo_capa_path) }}" alt="Capa do usuário">
                        @else
                            <div class="no-image">Nenhuma foto de capa.</div>
                        @endif
                    </label>

                    <div class="buttons">
                        <div class="btn" wire:click="toggleImageProfileCap">Cancelar</div>
                        @if (Auth::user()->profile_photo_capa_path)
                            <div class="btn" wire:click="removePhoto">Remover imagem</div>
                        @endif
                        <button type="submit" class="btn">Salvar nova capa</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif



    <main>
    <h1>Definições</h1>
    <hr>
    <a id="toggle-mode">
        <div class="box">
            <div class="icons">
                <i class="fa-solid fa-circle-half-stroke"></i>
                <span>Alterar modo de fundo</span>
            </div>
            <div>
                <i class="fa-solid fa-arrow-right-long"></i>
            </div>
        </div>
    </a>


    <a wire:click="toggleProfileImage">
        <div class="box">
            <div class="icons">
                <i class="fa fa-edit"></i>
                <span>Alterar a sua foto de perfil</span>
            </div>
            <div>
                <i class="fa-solid fa-arrow-right-long"></i>
            </div>
        </div>
    </a>

    <a wire:click="toggleImageProfileCap">
        <div class="box">
            <div class="icons">
                <i class="fa fa-edit"></i>
                <span>Alterar imagem de capa do seu perfil</span>
            </div>
            <div>
                <i class="fa-solid fa-arrow-right-long"></i>
            </div>
        </div>
    </a>

    <a wire:click="toggleProfileEmail">
        <div class="box">
            <div class="icons">
                <i class="fa fa-edit"></i>
                <span>Alterar seu email</span>
            </div>
            <div>
                <i class="fa-solid fa-arrow-right-long"></i>
            </div>
        </div>
    </a>

    <a wire:click="togglePassWord">
        <div class="box">
            <div class="icons">
                <i class="fa fa-edit"></i>
                <span>{{__('Update Password')}}</span>
            </div>
            <div>
                <i class="fa-solid fa-arrow-right-long"></i>
            </div>
        </div>
    </a>

    <h3>{{__('Danger zone')}}</h3>

    <hr>

    <a href="/">
        <div class="box red">
            <div class="icons">
                <i class="fa-regular fa-snowflake"></i>
                <span>Congelar a sua conta</span>
            </div>
            <div>
                <i class="fa-solid fa-arrow-right-long"></i>
            </div>
        </div>
    </a>

    <a wire:click="toggleModal">
        <div class="box red">
            <div class="icons">
                <i class="fa fa-trash"></i>
                <span>{{__('Delete Account')}}</span>
            </div>
            <div>
                <i class="fa-solid fa-arrow-right-long"></i>
            </div>
        </div>
    </a>

    <form action="/logout" method="post">
        @csrf
        <a href="./logout"
            onclick="event.preventDefault();
            this.closest('form').submit();"
        >
            <div class="box red">
                <div class="icons">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <span>Terminar sessão</span>
                </div>
                <div>
                    <i class="fa-solid fa-arrow-right-long"></i>
                </div>
            </div>
        </a>

    </form>
    <div wire:offline>
        <livewire:all-pages />
    </div>
    </main>
</div>
