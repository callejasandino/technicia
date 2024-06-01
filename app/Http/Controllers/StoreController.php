<?php

namespace App\Http\Controllers;

use App\Services\StoreService;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function index()
    {
        return StoreService::index();
    }

    public function store(Request $request)
    {
        return StoreService::store($request);
    }

    public function update(Request $request)
    {
        return StoreService::update($request);
    }

    public function inactivate(Request $request)
    {
        return StoreService::inactivate($request);
    }

    public function activate(Request $request)
    {
        return StoreService::activate($request);
    }

    public function delete(Request $request)
    {
        return StoreService::delete($request);
    }
}
