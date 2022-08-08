<?php

namespace App\View\Components;

use App\Models\Approvisionement;
use App\Models\Produit;
use Illuminate\View\Component;

class ModalApproSortie extends Component
{
    public $produit;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Produit $produit,Approvisionement $approvisionnement)
    {
        $this->produit = $produit;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.modal-appro-sortie');
    }
}
