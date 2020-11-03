<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\HopResource;
use App\Models\Hop;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HopController extends Controller
{
    public function index(): JsonResource
    {
        return HopResource::collection(Hop::all());
    }

    public function store(Request $request): JsonResponse
    {
        Hop::create($this->validateHopForm());
        return response()->json($request, 201);
    }

    public function show(Hop $hop): JsonResource
    {
        return new HopResource($hop);
    }

    public function update(Request $request, Hop $hop): JsonResponse
    {
        $validatedForm = $this->validateHopForm();
        $hop->update($validatedForm);

        return response()->json($hop, 201);
    }

    public function destroy(Hop $hop): JsonResponse
    {
        $hop->delete();

        return response()->json(null, 204);
    }

    protected function validateHopForm(): array
    {
        return request()->validate([
            'name' => 'required|min:3|max:255',
            'alpha_acid' => 'required|min:1|max:3',
            'amount' => 'required|min:1',
            'expiration_date' => 'required|date'
        ]);
    }
}
