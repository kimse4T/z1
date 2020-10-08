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
        $inputProperty = [
            "address" => $request->all('address')['address'],
            "land_width" => $request->all('land_width')['land_width'],
            "land_length" => $request->all('land_length')['land_length'],
            "land_area" => $request->all('land_area')['land_area'],
            "sale_price_asking" => $request->all('sale_price_asking')['sale_price_asking'],
            "sale_asking_price_per_sqm" => $request->all('sale_asking_price_per_sqm')['sale_asking_price_per_sqm'],
            "sale_price" => $request->all('sale_price')['sale_price'],
            "sale_price_per_sqm" => $request->all('sale_price_per_sqm')['sale_price_per_sqm'],
            "sale_list_price" => $request->all('sale_list_price')['sale_list_price'],
            "sale_list_price_per_sqm" => $request->all('sale_list_price_per_sqm')['sale_list_price_per_sqm'],
            "sold_price" => $request->all('sold_price')['sold_price'],
            "sold_price_per_sqm" => $request->all('sold_price_per_sqm')['sold_price_per_sqm'],
            "sale_commission" => $request->all('sale_commission')['sale_commission'],
            "rent_price_asking" => $request->all('rent_price_asking')['rent_price_asking'],
            "rent_asking_price_per_sqm" => $request->all('rent_asking_price_per_sqm')['rent_asking_price_per_sqm'],
            "rent_price" => $request->all('rent_price')['rent_price'],
            "rent_price_per_sqm" => $request->all('rent_price_per_sqm')['rent_price_per_sqm'],
            "rent_list_price" => $request->all('rent_list_price')['rent_list_price'],
            "rent_list_price_per_sqm" => $request->all('rent_list_price_per_sqm')['rent_list_price_per_sqm'],
            "rented_price" => $request->all('rented_price')['rented_price'],
            "rented_price_per_sqm" => $request->all('rented_price_per_sqm')['rented_price_per_sqm'],
            "rental_cmmission" => $request->all('rental_cmmission')['rental_cmmission'],
            "created_at" => $request->all('created_at')['created_at'],
            "updated_at" => $request->all('updated_at')['updated_at'],
        ];

        $inputTitleDeed = [
            "title_deed_type" => $request->all('title_deed_type')['title_deed_type'],
            "title_deed_no" => $request->all('title_deed_no')['title_deed_no'],
            "issued_year" => $request->all('issued_year')['issued_year'],
            "parcel_no" => $request->all('parcel_no')['parcel_no'],
            "total_size_by_title_deed" => $request->all('total_size_by_title_deed')['total_size_by_title_deed'],
        ];

        $inputUnit = [
            'unit_name' => $request->all('unit_name')['unit_name'],
            'unit_width' => $request->all('unit_width')['unit_width'],
            'unit_length' => $request->all('unit_length')['unit_length'],
            'unit_total_size' => $request->all('unit_total_size')['unit_total_size'],
            'unit_gross_floor_area' => $request->all('unit_gross_floor_area')['unit_gross_floor_area'],
            'unit_bedroom'  => $request->all('unit_bedroom')['unit_bedroom'],
            'unit_bathroom' => $request->all('unit_bathroom')['unit_bathroom'],
            'unit_livingroom'  => $request->all('unit_livingroom')['unit_livingroom'],
            'unit_floor'  => $request->all('unit_floor')['unit_floor'],
            'unit_storey'   => $request->all('unit_storey')['unit_storey'],
            'unit_car_parking'    => $request->all('unit_car_parking')['unit_car_parking'],
            'unit_motor_parking'  => $request->all('unit_motor_parking')['unit_motor_parking'],
            'unit_cost_estimates'  => $request->all('unit_cost_estimates')['unit_cost_estimates'],
            'unit_usefull_life'  => $request->all('unit_usefull_life')['unit_usefull_life'],
            'unit_effective_age'  => $request->all('unit_effective_age')['unit_effective_age'],
            'unit_completion_year'  => $request->all('unit_completion_year')['unit_completion_year'],
        ];

        $titleDeed=["propertyTitleDeedRepeatable" => json_encode($inputTitleDeed)];

        //dd($input);

        $property = $this->propertyRepository->create($inputProperty);

        // $this->propertyTitleDeedRepo->create($titleDeed,$property->id);

        $response=array_merge($property->toArray(),$inputTitleDeed,$inputUnit);

        //dd($input);

        $property = $this->propertyRepository->create($inputProperty);

        if (empty($property)) {
            return $this->sendError('Can not create property');
        }

        return $this->sendResponse($response, 'Property saved successfully');
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
