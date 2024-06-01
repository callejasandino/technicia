<?php

namespace App\Services;

use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class StoreService
{
    public static function index()
    {
        $authUser = Auth::user();

        $stores = Store::where('user_id', $authUser->id)
            ->where('is_active', true)
            ->get();

        return response()->json([
            'stores' => $stores
        ]);
    }

    public static function store(Request $request)
    {

        $authUser = Auth::user();
        $slug = self::generateUniqueSlug();

        Store::create([
            'user_id' => $authUser->id,
            'name' => $request->input('name'),
            'address' => $request->input('address'),
            'slug' => $slug,
            'classification' => $request->input('classification'),
        ]);

        return response()->json([
            'message' => 'Store Created'
        ], 200);
    }

    public static function update(Request $request)
    {
        $store = self::findStoreBySlug($request->input('slug'));

        if (!$store) {
            return response()->json([
                'error' => 'Store not found'
            ], 404);
        }

        $store->update([
            'name' => $request->input('name'),
            'address' => $request->input('address'),
            'classification' => $request->input('classification')
        ]);


        return response()->json([
            'message' => 'Store updated'
        ], 200);
    }

    public static function inactivate(Request $request)
    {
        return self::toggleStoreActivation($request->input('slug'), false);
    }

    public static function activate(Request $request)
    {
        return self::toggleStoreActivation($request->input('slug'), true);
    }

    public static function delete(Request $request)
    {
        $store = self::findStoreBySlug($request->input('slug'));

        if (!$store) {
            return response()->json([
                'error' => 'Store not found'
            ], 404);
        }

        $store->delete();

        return response()->json([
            'message' => 'Store deleted'
        ], 200);
    }

    private static function findStoreBySlug($slug)
    {
        return Store::where('slug', $slug)->first();
    }

    private static function generateUniqueSlug()
    {
        do {
            $slug = Str::random(50);
        } while (Store::where('slug', $slug)->exists());

        return $slug;
    }

    private static function toggleStoreActivation($slug, $status)
    {
        $store = self::findStoreBySlug($slug);

        if (!$store) {
            return response()->json([
                'error' => 'Store not found'
            ], 404);
        }

        $store->update([
            'is_active' => $status,
        ]);

        return response()->json([
            'message' => 'Store ' . ($status ? 'activated' : 'inactivated')
        ], 200);
    }
}
