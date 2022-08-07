<?php

namespace App\View\Components;

use App\Models\Produit;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class ModalAddAppro extends Component
{
    public $produits;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Collection $produits)
    {
        $this->produits = $produits;
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
