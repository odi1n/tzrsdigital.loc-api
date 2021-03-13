<?php

namespace App\Http\Controllers\API;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Catalog;
use Validator;

class CatalogController extends BaseController
{
    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $catalogs = Catalog::all();
        return $this->sendResponse($catalogs->toArray(), "Все каталоги успешно получены");
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
            'title' => [
                'required',
                'string',
                'unique:catalogs'
            ],
        ]);

        if($validator->fails()){
            return $this->sendError('Ошибка валидации.', $validator->errors());
        }

        $catalog = Catalog::create($input);
        return $this->sendResponse($catalog->toArray(), 'Каталог успешно добавлен');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Catalog  $catalog
     * @return \Illuminate\Http\Response
     */
    public function show(Catalog $catalog)
    {
        if (is_null($catalog) || $catalog->count() == 0) {
            return $this->sendError('Каталог не найден');
        }
        return $this->sendResponse($catalog->toArray(), 'Каталог успешно получен');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Catalog  $catalog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Catalog $catalog)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'title' => [
                'required',
                'string',
                'unique:catalogs'
            ],
        ]);
        if($validator->fails()){
            return $this->sendError('Ошибка валидации.', $validator->errors());
        }
        $catalog->title = $input['title'];
        $catalog->save();
        return $this->sendResponse($catalog->toArray(), 'Каталог успешно изменен');
    }
}
