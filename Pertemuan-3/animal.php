<?php

# membuat class Animal
class Animal
{
    # property animals
    public $animal;

    # method constructor - mengisi data awal
    # parameter: data hewan (array)
    public function __construct($data) {
        $this->animal = $data;
    }

    # method index - menampilkan data animals
    public function index()
    {
        # gunakan foreach untuk menampilkan data animals (array)
        foreach ($this->animal as $key => $value) {
            echo ($key+1). ". ". $value. "<br>";
        }
    }

    # method store - menambahkan hewan baru
    # parameter: hewan baru
    public function store($data)
    {
        # gunakan method array_push untuk menambahkan data baru
        array_push($this->animal, $data);
    }

    # method update - mengupdate hewan
    # parameter: index dan hewan baru
    public function update($index, $data) {
        if (isset($this->animal[$index])) {
            $this->animal[$index] = $data;
        } else {
            echo "Gagal mengupdate, tidak ada hewan dengan index $index <br>";
        }
    }

    # method delete - menghapus hewan
    # parameter: index
    public function destroy($index)
    {
        # gunakan method unset atau array_splice untuk menghapus data array
        if (isset($this->animal[$index])) {
            unset($this->animal[$index]);
        } else {
            echo "Gagal menghapus, tidak ada hewan dengan index $index <br>";
        }
    }
}

# membuat object
# kirimkan data hewan (array) ke constructor
$animal = new Animal(['Singa', 'Harimau', 'Leopard', 'Cheetah', 'Jaguar']);

echo "Index - Menampilkan seluruh hewan <br>";
$animal->index();
echo "<br>";

echo "Store - Menambahkan hewan baru <br>";
$animal->store('Puma');
$animal->index();
echo "<br>";

echo "Update - Mengupdate hewan <br>";
$animal->update(2, 'Snow Leopard');
$animal->index();
echo "<br>";

echo "Destroy - Menghapus hewan <br>";
$animal->destroy(1);
$animal->index();
echo "<br>";
?>