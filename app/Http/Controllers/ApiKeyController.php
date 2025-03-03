<?php

namespace App\Http\Controllers;

use App\Models\ApiKey;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ApiKeyController extends Controller
{
    public function index()
    {
        $apiKeys = ApiKey::all();
        return view('dashboard.api-keys', compact('apiKeys'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        ApiKey::create([
            'name' => $request->name,
            'key' => Str::random(32),
        ]);

        return redirect()->route('dashboard.api-keys')->with('success', 'API Key created successfully.');
    }

    public function destroy(ApiKey $apiKey)
    {
        $apiKey->delete();
        return redirect()->route('dashboard.api-keys')->with('success', 'API Key deleted successfully.');
    }
}