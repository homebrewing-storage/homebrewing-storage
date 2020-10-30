<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Yeast;

class YeastController extends Controller
{
    public function index()
    {
        return Yeast::all();
    }

    public function show($name)
    {
        return Yeast::where('name', '=', $name)->firstOrFail();
    }

    public function store(Request $request)
    {
        $id = $request->get('id');
        $name = $request->get('name');

        if($id)
        {
            $amountBase = $request->get('amount');

            $findHop = Yeast::findOrFail($id);
            Yeast::where('name', '=', $name)->firstOrFail();
            $amountToAdd = $findHop->amount;

            $amountNew = $amountBase + $amountToAdd;
            $findHop->amount = $amountNew;
            $findHop->save();

            return response()->json($findHop, 200);
        }

        $hop = Yeast::create($request->all());

        return response()->json($hop, 201);
    }

    public function delete($id)
    {
        $hop = Yeast::findOrFail($id);
        $hop->delete();

        return response()->json(null, 204);
    }

    public function all($userId)
    {
        return Yeast::where('user_id', '=', $userId)->get();
    }
}
