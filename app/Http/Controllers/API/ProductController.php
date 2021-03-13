<?php

namespace App\Http\Controllers\API;

use App\Models\PropertiesLists;
use App\Models\Property;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Product;
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

        for($i = 0; $i < count($products);$i++){
            $products[$i]->properties;
            $products[$i]->catalogs;
        }
//        $test = Product::whereHas('catalogs', function ($q) use($ss) {
//            $q->where('catalogs_id', '=', $ss);
//        })->get();

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
            return $this->sendError('Validation Error.', $validator->errors());
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
            return $this->sendError('Product not found.');
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
            return $this->sendError('Validation Error.', $validator->errors());
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
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return $this->sendResponse($product->toArray(), 'Продукт удален');
    }
}
