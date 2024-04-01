<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Item::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreItemRequest $request)
    {
        $data = $request->validated();

        $item = Item::create([
            'name' => $data['name'],
            'category' => $data['category'],
            'status' => $data['status'],
            'quantity' => $data['quantity'],
        ]);

        return response()->json($item);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $item)
    {
        return response()->json(Item::findOrFail($item));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateItemRequest $request, int $id)
    {
        $data = $request->validated();

        $item = Item::findOrFail($id);
        $item->update([
            'name' => $data['name'],
            'category' => $data['category'],
            'status' => $data['status'],
            'quantity' => $data['quantity'],
        ]);
    
        return response()->json($item);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $item = Item::findOrFail($id);
        $item->delete();
        return response()->json(['message'=> "Item $id was destroy"]);
    }
}
