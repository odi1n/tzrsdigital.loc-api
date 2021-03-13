<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Product;
use App\Models\PropertiesLists;
use Illuminate\Http\Request;
use Validator;


class ProductController extends BaseController
{
    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(int $paginateCount = 40)
    {
        $products = Product::paginate($paginateCount);

        for ($i = 0; $i < count($products); $i++) {
            $products[$i]->properties;
            $products[$i]->catalogs;
        }

        return $this->sendResponse($products->toArray(), 'Все продукты успешно получены');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => ['required', 'string', 'unique:products'],
            'description' => ['string'],
            'price' => ['required', 'integer'],
            'count' => ['required', 'integer'],
            'catalogs_id' => ['required', 'integer'],
        ]);

        if ($validator->fails()) {
            return $this->sendError('Ошибка валидации.', $validator->errors());
        }

        $product = Product::create($input);
        return $this->sendResponse($product->toArray(), 'Продукт успешно добавлен');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        if (is_null($product)) {
            return $this->sendError('Продукт не найден');
        }
        $product->properties;
        $product->catalogs;
        return $this->sendResponse($product->toArray(), 'Продукт успешно получен');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => ['string', 'unique:products'],
            'description' => ['string'],
            'price' => ['integer'],
            'count' => ['integer'],
            'catalogs_id' => ['integer'],
        ]);

        if ($validator->fails()) {
            return $this->sendError('Ошибка валидации.', $validator->errors());
        }

        $product->name = $input['name'];
        $product->description = $input['description'];
        $product->price = $input['price'];
        $product->count = $input['count'];
        $product->catalogs_id = $input['catalogs_id'];
        $product->save();
        return $this->sendResponse($product->toArray(), 'Продукт успешно изменен');
    }

    /**
     * Фильтрация данных
     */
    public function filter(Request $request)
    {
        $reqParams = $request->all();

        if (array_key_exists('properties', $reqParams)) {
            $keys = array();
            $values = array();

            try {
                foreach ($reqParams['properties'] as $key => $keyValue) {
                    array_push($keys, $key);
                    foreach ($keyValue as $value) {
                        array_push($values, $value);
                    }
                }

                $products = Product::whereHas('properties', function ($q) use ($keys, $values) {
                    $q->whereIn('title', $keys);
                    $q->whereIn('value', $values);
                })->get();
            }
            catch (\Exception $exception){
                return $this->sendError('Ошибка валидации.', ['error'=>'Неправильно указаны данные. Пример: properties[NAME][]=VALUE']);
            }

        } else {
            $products = Product::all();
        }

        if (array_key_exists('priceFrom', $reqParams))
            $products = $products->where('price', '>=', $reqParams['priceFrom']);

        if (array_key_exists('priceTo', $reqParams))
            $products = $products->where('price', '<', $reqParams['priceTo']);

        if (array_key_exists('count', $reqParams))
            $products = $products->where('count', '>=', $reqParams['count']);

        if (array_key_exists('q', $reqParams))
            if($reqParams['q'] != null)
                $products = $products->where('name', '=', $reqParams['q']);

        return $this->sendResponse($products->toJson(), 'Продукты отфильтрованы');
    }
}
