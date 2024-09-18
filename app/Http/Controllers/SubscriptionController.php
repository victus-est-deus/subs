<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscription;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
    public function subscribe(Request $request, $product_id)
    {

        if (Auth::check()) {
            $user_id = Auth::id();
            $product = Product::find($product_id);

            if ($product) {
                Subscription::create([
                    'user_id' => $user_id,
                    'product_id' => $product_id,
                ]);

                return response()->json(['message' => 'Subscribed successfully!']);
            } else {
                return response()->json(['error' => 'Product not found'], 404);
            }
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }
    public function cancel(Request $request, $product_id): \Illuminate\Http\JsonResponse
    {

        if (Auth::check()) {
            $user_id = Auth::id();


            $subscription = Subscription::where('user_id', $user_id)
                ->where('product_id', $product_id)
                ->first();

            if ($subscription) {
                $subscription->delete();

                return response()->json(['message' => 'Subscription canceled successfully!']);
            } else {
                return response()->json(['error' => 'Subscription not found'], 404);
            }
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }
}

