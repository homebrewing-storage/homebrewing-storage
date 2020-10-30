<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Fermentable;
use Illuminate\Http\Request;
use App\Models\Extra;

class ExtraController extends Controller
{
    public function index()
    {
        return Extra::all();
    }

    public function show($name)
    {
        return Extra::where('name', '=', $name)->firstOrFail();
    }

    public function store(Request $request)
    {
        $id = $request->get('id');
        $name = $request->get('name');

        if($id)
        {
            $amountBase = $request->get('amount');

            $findHop = Extra::findOrFail($id);
            Extra::where('name', '=', $name)->firstOrFail();
            $amountToAdd = $findHop->amount;

            $amountNew = $amountBase + $amountToAdd;
            $findHop->amount = $amountNew;
            $findHop->save();

            return response()->json($findHop, 200);
        }

        $hop = Extra::create($request->all());

        return response()->json($hop, 201);
    }

    public function delete($id)
    {
        $hop = Extra::findOrFail($id);
        $hop->delete();

        return response()->json(null, 204);
    }

    public function all($userId)
    {
        return Fermentable::where('user_id', '=', $userId)->get();
    }
}
