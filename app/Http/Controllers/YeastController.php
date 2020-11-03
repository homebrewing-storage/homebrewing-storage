<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\YeastResource;
use App\Models\Yeast;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class YeastController extends Controller
{
    public function index(): JsonResource
    {
        return YeastResource::collection(Yeast::all());
    }

    public function store(Request $request): JsonResponse
    {
        Yeast::create($this->validateHopForm());
        return response()->json($request, 201);
    }

    public function show(Yeast $yeast): JsonResource
    {
        return new YeastResource($yeast);
    }

    public function update(Request $request, Yeast $yeast): JsonResponse
    {
        $validatedForm = $this->validateHopForm();
        $yeast->update($validatedForm);

        return response()->json($yeast, 201);
    }

    public function destroy(Yeast $yeast): JsonResponse
    {
        $yeast->delete();

        return response()->json(null, 204);
    }

    protected function validateHopForm(): array
    {
        return request()->validate([
            'name' => 'required|min:3|max:255',
            'type' => 'required',
            'amount' => 'required|min:1',
            'expiration_date' => 'required|date'
        ]);
    }
}
