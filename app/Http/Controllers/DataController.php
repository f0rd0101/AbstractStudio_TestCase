<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\DataService;
use App\Http\Requests\DataRequest;

class DataController extends Controller
{
    
    protected DataService $dataService;

    public function __construct(DataService $dataService){
      $this->dataService = $dataService;
    }


    public function index(){
        $data = $this->dataService->showAll();
        return response()->json($data);
    }

    public function store(DataRequest $request){
        $validatedBody = $request->validated();
        $data = $this->dataService->storeData($validatedBody);
        
        return response()->json([
            'message' => 'User Data Added!',
            'data' => $data
        ], 201);

        
    }
}
