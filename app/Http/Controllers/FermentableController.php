<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\FermentableResource;
use App\Models\Fermentable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FermentableController extends Controller
{
    public function index(): JsonResource
    {
        return FermentableResource::collection(Fermentable::all());
    }

    public function store(Request $request): JsonResponse
    {
        Fermentable::create($this->validateHopForm());
        return response()->json($request, 201);
    }

    public function show(Fermentable $fermentable): JsonResource
    {
        return new FermentableResource($fermentable);
    }

    public function update(Request $request, Fermentable $fermentable): JsonResponse
    {
        $validatedForm = $this->validateHopForm();
        $fermentable->update($validatedForm);

        return response()->json($fermentable, 201);
    }

    public function destroy(Fermentable $fermentable): JsonResponse
    {
        $fermentable->delete();

        return response()->json(null, 204);
    }

    protected function validateHopForm(): array
    {
        return request()->validate([
            'name' => 'required|min:3|max:255',
            'type' => 'required|min:3|max:255',
            'yield' => 'required|min:1|max:255',
            'ebc' => 'required|min:1|max:255',
            'amount' => 'required|min:1',
            'expiration_date' => 'required|date'
        ]);
    }
}
