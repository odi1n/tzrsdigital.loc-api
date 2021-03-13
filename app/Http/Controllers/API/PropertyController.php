<?php

namespace App\Http\Controllers\API;

use App\Models\Product;
use App\Models\Property;
use Illuminate\Http\Request;
use Validator;

class PropertyController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $properties = Property::all();
        return $this->sendResponse($properties->toArray(), 'Все продукты успешно получены');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'title' => ['string'],
            'value' => ['string'],
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $property = Property::create($input);
        return $this->sendResponse($property->toArray(), 'Свойство успешно добавлен');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function show(Property $property)
    {
        if (is_null($property) || $property->count() == 0) {
            return $this->sendError('Catalog not found.');
        }
        return $this->sendResponse($property->toArray(), 'Свойство успешно получено');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Property $property)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'title' => ['string'],
            'value' => ['string'],
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $property->title = $input['title'];
        $property->value = $input['value'];
        $property->save();
        return $this->sendResponse($property->toArray(), 'Свойство успешно изменено');
    }
}
