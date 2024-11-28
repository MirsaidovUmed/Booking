<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Services\FacilityService;
use App\Dto\FacilityDto;
use Illuminate\Contracts\Validation\Factory as ValidationFactory;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class FacilityController extends Controller
{
    protected FacilityService $facilityService;
    protected ValidationFactory $validator;

    public function __construct(FacilityService $facilityService, ValidationFactory $validator)
    {
        $this->facilityService = $facilityService;
        $this->validator = $validator;
    }

    public function index()
    {
        return $this->facilityService->index();
    }

    /**
     * @throws ValidationException
     */
    public function store(Request $request): JsonResponse
    {
        $this->validator->make($request->all(), [
            'title' => 'required|string|max:255',
            'entity_id' => 'required|integer',
            'entity_type' => 'required|in:hotel,room',
        ])->validate();

        $facilityDto = new FacilityDto(
            $request->input('title'),
            $request->input('entity_id'),
            $request->input('entity_type')
        );

        $this->facilityService->create($facilityDto);

        return response()->json(['status' => 'Facility Added successfully'], 201);
    }

    /**
     * @throws ValidationException
     */
    public function update(Request $request, int $id): JsonResponse
    {
        $this->validator->make($request->all(), [
            'title' => 'required|string|max:255',
            'entity_id' => 'required|integer',
            'entity_type' => 'required|in:hotel,room',
        ])->validate();

        $facilityDto = new FacilityDto(
            $request->input('title'),
            $request->input('entity_id'),
            $request->input('entity_type')
        );

        $this->facilityService->update($facilityDto, $id);
        return response()->json(['status' => 'Facility Updated successfully'], 202);
    }

    public function destroy(int $id): Response
    {
        $this->facilityService->delete($id);
        return response()->noContent();
    }
}
