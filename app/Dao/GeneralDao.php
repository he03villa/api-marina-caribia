<?php

namespace App\Dao;

use App\Models\Genral;

class GeneralDao {
    public function getGeneral() {
        return Genral::first();
    }

    public function updateGeneral($data) {
        return Genral::updateOrCreate(['id' => 1], $data);
    }

    public function getGeneralById($id) {
        return Genral::find($id);
    }

    public function updateGeneralById($id, $data) {
        return Genral::find($id)->update($data);
    }

    public function deleteGeneral($id) {
        return Genral::find($id)->delete();
    }

    public function createGeneral($data) {
        return Genral::create($data);
    }

    public function getGeneralByName($name) {
        return Genral::where('name', $name)->first();
    }
}