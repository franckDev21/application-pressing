<?php

namespace App\Http\Controllers;

use App\Models\TypeLavage;
use Illuminate\Http\Request;

class TypeLarvementController extends Controller
{
    public function indexApi(){
        return TypeLavage::all();
    }
}
