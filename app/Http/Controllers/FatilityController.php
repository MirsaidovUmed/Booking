<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\FacilityService;
use App\Dto\FacilityDto;
use Illuminate\Contracts\Validation\Factory as ValidationFactory;

class FatilityController extends Controller
{
    protected $facilityService;
    protected $validator;

    public function __construct(FacilityService $facilityService, ValidationFactory $validator)
    {
        $this->facilityService = $facilityService;
        $this->validator = $validator;
    }

    public function store(Request $request)
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

        return back()->with('status', 'Facility created successfully');
    }

    public function update(Request $request, int $id)
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
    }
}
