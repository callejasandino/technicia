<?php

namespace App\Services;

use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function App\Traits\notFoundResponse;
use function App\Traits\okayResponse;
use function App\Traits\queryResponse;

class InventoryService
{
    public static function index(Request $request) {
        $inventories = Inventory::where('user_id', $request->input('user_id'))
        ->get();

        return queryResponse('invetories', $inventories);
    }

    public static function store(Request $request) {
        $authUser = Auth::user();
        
        $quantity = $request->input('quantity');

        $inventory = Inventory::create([
            'user_id' => $authUser->id,
            'sku' => $request->input('sku'),
            'item_name' => $request->input('item_name'),
            'description' => $request->input('decription'),
            'quantity' => $quantity,
            'is_active' => $quantity != 0 ? 1 : 0,
        ]);

        return okayResponse('message', "{$inventory->item_name} saved!");
    }

    public static function update(Request $request) {
        $authUser = Auth::user();
        $quantity = $request->input('quantity');

        $inventory = Inventory::where('sku', $request->input('sku'))
        ->where('user_id', $authUser->id)
        ->first();

        if (! $inventory) {
            return notFoundResponse('error', 'Item not found');
        }

        $inventory->update([
            'item_name' => $request->inout('item_name'),
            'description' => $request->inout('description'),
            'quantity' => $quantity,
            'is_active' => $quantity != 0 ? 1: 0,
        ]);

        return okayResponse('message', "{$inventory->item_name} updated");
    }

    public static function delete($sku) {
        $authUser = Auth::user();

        $inventory = Inventory::where('sku', $sku)
        ->where('user_id', $authUser->id)
        ->first();

        if (! $inventory) {
            return notFoundResponse('error', 'Item not found');
        }

        $inventory->delete();

        return okayResponse('message', 'Item Deleted');
    }
}
