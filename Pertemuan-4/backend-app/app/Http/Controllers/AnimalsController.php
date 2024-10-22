<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnimalsController extends Controller
{
    public $animal;
    public function __construct() {
        $this->animal = (['Singa', 'Harimau', 'Leopard', 'Cheetah', 'Jaguar']);
    }
    public function index(){
        foreach ($this->animal as $key => $value) {
            echo ($key+1). ". ". $value . "<br>";
        }
    }
    public function store(Request $request){
        array_push($this->animal, $request->nama_hewan);
        echo $this->index();
    }
    public function update(Request $request, $id){
        $this->animal[$id] = $request->nama_hewan;
        echo $this->index();
    }
    public function delete($id){
        unset($this->animal[$id]);
        echo $this->index();
    }
}
