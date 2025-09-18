<?php
namespace App\Http\Services;
use App\Models\UserData;

class DataService{
    public function showAll(){
        return auth()->user()->dataUsers()->get();
    }
    public function storeData(array $validatedBody){
        $validatedBody['user_id'] = auth()->id();
        return  UserData::create($validatedBody);
    }
}