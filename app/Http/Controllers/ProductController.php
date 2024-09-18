<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{

    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        if (Auth::check()) {
            $user_id = Auth::id();
            $request->validate([
                'name' => 'required|string|max:255',
                'price' => 'required|numeric',
                'description' => 'nullable|string',
            ]);


            Product::create([
                'supplier_id' => $user_id,
                'name' => $request->name,
                'price' => $request->price,
                'description' => $request->description,
            ]);

            return response()->json(['message' => 'Product created successfully!']);
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }
}
