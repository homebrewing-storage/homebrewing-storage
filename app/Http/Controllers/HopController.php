<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hop;

class HopController extends Controller
{
    public function index()
    {
        return Hop::all();
    }

    public function show($name)
    {
        return Hop::where('name', '=', $name)->firstOrFail();
    }

    public function store(Request $request)
    {
        $id = $request->get('id');
        $name = $request->get('name');

        if($id)
        {
            $amountBase = $request->get('amount');

            $findHop = Hop::findOrFail($id);
            Hop::where('name', '=', $name)->firstOrFail();
            $amountToAdd = $findHop->amount;

            $amountNew = $amountBase + $amountToAdd;
            $findHop->amount = $amountNew;
            $findHop->save();

            return response()->json($findHop, 200);
        }

        $hop = Hop::create($request->all());

        return response()->json($hop, 201);
    }

    public function delete($id)
    {
        $hop = Hop::findOrFail($id);
        $hop->delete();

        return response()->json(null, 204);
    }

    public function all($userId)
    {
        return Hop::where('user_id', '=', $userId)->get();
    }
}
