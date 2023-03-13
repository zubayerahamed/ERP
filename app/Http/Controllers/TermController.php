<?php

namespace App\Http\Controllers;

use App\Http\Controllers\admin\KitController;
use App\Models\Term;
use Attribute;
use Illuminate\Http\Request;

class TermController extends KitController
{
    public function index(Attribute $attribute){
        return view('admin.term', [
            'terms' => Term::all(),
            'term' => new Term(),
            'attribute' => $attribute
        ]);
    }
}
