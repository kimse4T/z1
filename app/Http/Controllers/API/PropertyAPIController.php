<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatePropertyAPIRequest;
use App\Http\Requests\API\UpdatePropertyAPIRequest;
use App\Models\Property;
use App\Repositories\PropertyRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class PropertyController
 * @package App\Http\Controllers\API
 */

class PropertyAPIController extends AppBaseController
{
    /** @var  PropertyRepository */
    private $propertyRepository;

    public function __construct(PropertyRepository $propertyRepo)
    {
        $this->propertyRepository = $propertyRepo;
    }

    /**
     * Display a listing of the Property.
     * GET|HEAD /properties
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        //dd("234");
        $properties = $this->propertyRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($properties->toArray(), 'Properties retrieved successfully');
    }

    /**
     * Store a newly created Property in storage.
     * POST /properties
     *
     * @param CreatePropertyAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatePropertyAPIRequest $request)
    {
        // dd("asf");
        $input = $request->all();

        // $property = $this->propertyRepository->create($input);

        // return $this->sendResponse($property->toArray(), 'Property saved successfully');
    }

    /**
     * Display the specified Property.
     * GET|HEAD /properties/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Property $property */
        $property = $this->propertyRepository->find($id);

        if (empty($property)) {
            return $this->sendError('Property not found');
        }

        return $this->sendResponse($property->toArray(), 'Property retrieved successfully');
    }

    /**
     * Update the specified Property in storage.
     * PUT/PATCH /properties/{id}
     *
     * @param int $id
     * @param UpdatePropertyAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePropertyAPIRequest $request)
    {
        $input = $request->all();

        /** @var Property $property */
        $property = $this->propertyRepository->find($id);

        if (empty($property)) {
            return $this->sendError('Property not found');
        }

        $property = $this->propertyRepository->update($input, $id);

        return $this->sendResponse($property->toArray(), 'Property updated successfully');
    }

    /**
     * Remove the specified Property from storage.
     * DELETE /properties/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Property $property */
        $property = $this->propertyRepository->find($id);

        if (empty($property)) {
            return $this->sendError('Property not found');
        }

        $property->delete();

        return $this->sendSuccess('Property deleted successfully');
    }
}
