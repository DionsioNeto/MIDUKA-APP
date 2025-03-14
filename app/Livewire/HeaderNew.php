<?php

namespace App\Livewire;

use Livewire\Component;

class HeaderNew extends Component{
    public $name, $price, $product_id;
    public $products;

    public function render(){
        $this->products = Product::all();
        return view('livewire.header-new');
    }

    public function store()
    {
        $this->validate([
            'name' => 'required',
            'price' => 'required|numeric',
        ]);

        Product::create([
            'name' => $this->name,
            'price' => $this->price,
        ]);

        session()->flash('message', 'Produto criado com sucesso.');
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $product = Product::find($id);
        $this->product_id = $product->id;
        $this->name = $product->name;
        $this->price = $product->price;
    }

    public function update()
    {
        $this->validate([
            'name' => 'required',
            'price' => 'required|numeric',
        ]);

        $product = Product::find($this->product_id);
        $product->update([
            'name' => $this->name,
            'price' => $this->price,
        ]);

        session()->flash('message', 'Produto atualizado com sucesso.');
        $this->resetInputFields();
    }

    public function delete($id)
    {
        Product::find($id)->delete();
        session()->flash('message', 'Produto deletado com sucesso.');
    }

    private function resetInputFields()
    {
        $this->name = '';
        $this->price = '';
        $this->product_id = null;
    }
}
