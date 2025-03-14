<div>
    <h2>Gerenciar Produtos</h2>

    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="{{ $product_id ? 'update' : 'store' }}">
        <input type="text" wire:model="name" placeholder="Nome do Produto" />
        <input type="text" wire:model="price" placeholder="Preço do Produto" />

        <button type="submit">{{ $product_id ? 'Atualizar' : 'Criar' }} Produto</button>
    </form>

    <hr>

    <h3>Produtos</h3>
    <ul>
        @foreach($products as $product)
            <li>
                {{ $product->name }} - R$ {{ number_format($product->price, 2, ',', '.') }}
                <button wire:click="edit({{ $product->id }})">Editar</button>
                <button wire:click="delete({{ $product->id }})">Deletar</button>
            </li>
        @endforeach
    </ul>

</div>
{{--

Migration

// database/migrations/xxxx_xx_xx_create_products_table.php

public function up()
{
    Schema::create('products', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->decimal('price', 8, 2);
        $table->timestamps();
    });
} --}}
