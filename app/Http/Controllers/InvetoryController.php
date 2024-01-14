<?php

namespace App\Http\Controllers;

use App\Services\InventoryService;
use Illuminate\Http\Request;

class InvetoryController extends Controller
{
    public function index(Request $request) {
        return InventoryService::index($request);
    }

    public function store(Request $request) {
        return InventoryService::store($request);
    }

    public function update(Request $request) {
        return InventoryService::update($request);
    }

    public function delete($sku) {
        return InventoryService::delete($sku);
    }
}
