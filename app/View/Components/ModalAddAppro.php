<?php

namespace App\View\Components;

use App\Models\Produit;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class ModalAddAppro extends Component
{
    public $produits;
    public $produit;
    public $edit;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(?Collection $produits,Produit $produit,bool $edit = false)
    {
        $this->produits = $produits;
        $this->produit = $produit;
        $this->edit = $edit;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.modal-add-appro');
    }
}
