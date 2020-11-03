<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\ExtraResource;
use App\Models\Extra;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ExtraController extends Controller
{
    public function index(): JsonResource
    {
        return ExtraResource::collection(Extra::all());
    }

    public function store(Request $request): JsonResponse
    {
        Extra::create($this->validateHopForm());
        return response()->json($request, 201);
    }

    public function show(Extra $extra): JsonResource
    {
        return new ExtraResource($extra);
    }

    public function update(Request $request, Extra $extra): JsonResponse
    {
        $validatedForm = $this->validateHopForm();
        $extra->update($validatedForm);

        return response()->json($extra, 201);
    }

    public function destroy(Extra $extra): JsonResponse
    {
        $extra->delete();

        return response()->json(null, 204);
    }

    protected function validateHopForm(): array
    {
        return request()->validate([
            'name' => 'required|min:3|max:255',
            'type' => 'required|min:3|max:255',
            'amount' => 'required|min:1',
            'expiration_date' => 'required|date'
        ]);
    }
}
