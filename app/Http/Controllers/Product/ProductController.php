<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductMedia;
use App\Models\ProductPrices;
use App\Models\ProductTranslation;
use App\Models\Tag;
use App\Models\UserActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{

    private $index_view;
    private $create_view;
    private $edit_view;
    private $edit_variation_view;
    private $show_view;
    private $index_route;
    private $model_instance;
    private $success_message;
    private $error_message;
    private $update_success_message;
    private $update_error_message;
    private $model_instance_translation;


    public function __construct()
    {

        $this->index_view = 'dashboard.products.index';
        $this->create_view = 'dashboard.products.create';
        $this->show_view = 'products.show';
        $this->edit_view = 'dashboard.products.edit';
        $this->edit_variation_view = 'dashboard.products.edit_variation';
        $this->index_route = 'dashboard.product.index';
        $this->create_route = 'product.create';
        $this->edit_route = 'dashboard.product.edit';
        $this->success_message = 'Product Added successfully';
        $this->delete_message = 'Product deleted successfully';
        $this->error = 'Something went Wrong';
        $this->update_success_message = 'Product Updated successfully';
        $this->error_message = "Product Couldn't be Added";
        $this->update_error_message = "Product Couldn't Been Updated";
        $this->model_instance = Product::class;
    }

    private function StoreValidationRules()
    {
        return [
            'sku' => 'nullable|string|min:3|max:30',
            'name' => 'required|string|min:3|max:200',
            'description' => 'required|string|min:3|max:1000',
            'image' => 'required|image',
            'image.*' => 'image|mimes:jpg,jpeg,png',
            'category_id' => 'nullable|exists:categories,id',
            'prices' => 'nullable|array',
            'translations' => 'nullable|array',
        ];
    }

    private function UpdateValidationRules()
    {
        return [
            'sku' => 'nullable|string|min:3|max:30',
            'name' => 'required|string|min:3|max:200',
            'description' => 'required|string|min:3|max:300',
            'image' => 'image',
            'image.*' => 'image|mimes:jpg,jpeg,png',
            'category_id' => 'required|exists:categories,id',
            'prices' => 'nullable|array',
            'translations' => 'nullable|array',

        ];
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $filter = request()->has('filter') ? request()->filter : 'all';


        if ($filter == "all") {
            $products = Product::all()->sortBy('id');
        } else
            $products = Product::all()->sortBy('id');
           // $products = Category::findOrFail($filter)->products()->latest()->get();

        $categories = Category::where('status', '=', 'active')->get();

        return view($this->index_view, compact(['products', 'categories', 'filter']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        //has_access('product_create');
        $categories = Category::all();
        $attributes = Attribute::all();
        return view($this->create_view, compact(['categories', 'attributes']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // has_access('product_create');
        $validated_data = $request->validate($this->StoreValidationRules());

        try {
            $object = $this->model_instance::create(Arr::except($validated_data, ['image']));
            if ($request->has('image')) {
                $image = $validated_data["image"];
                $img_file_path = Storage::disk('public_images')->put('products', $image);
                $image_name = $request->file('image')->getClientOriginalName();
                $image_url = getMediaUrl($img_file_path);
                $object->image_url = $image_url;
                $object->image_name = $image_name;
                $object->update();
            }
            if ($request->has('prices')) {
                $prices = $request->prices;
                foreach ($prices as $price) {
                    ProductPrices::create([
                        'product_id' => $object->id,
                        'size' => $price['size'],
                        'type' => 'none',
                        'description' => 'none',
                        'price' => $price['price'],
                    ]);
                }
            }
            if ($request->has('translations')) {
                $translations = $request->translations;
                foreach ($translations as $translation) {
                    ProductTranslation::create([
                        'product_id' => $object->id,
                        'lang' => $translation['language'],
                        'name' => $translation['name'],
                        'description' => $translation['description'],
                    ]);
                }
            }
            $log_message = trans('products.create_log') . '#' . $object->id;
            UserActivity::logActivity($log_message);

            return redirect()->route($this->create_route, $object->id)->with('success', $this->success_message);
        } catch (\Exception $ex) {

            Log::error($ex->getMessage());
            return redirect()->route($this->create_route)->with('error', $this->error_message);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = $this->model_instance::findOrFail($id);
        $relatedProducts = Product::whereNotIn('id', [$product->id])
            ->inRandomOrder()
            ->limit(10)
            ->get();
        return view($this->show_view, compact('product', 'relatedProducts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        //has_access('product_update');

        $product = $this->model_instance::findOrFail($id);
        $attributes = Attribute::all();
        $categories = Category::where('status', '=', 'active')->get();


        return view($this->edit_view, compact(['product', 'categories', 'attributes']));
    }


    public function editVariation($id)
    {


        // has_access('product_update');

        $product = $this->model_instance::findOrFail($id);
        $attributes = Attribute::all();
        $variation_attributes = $product->parent()->variation_attributes($product->id)->pluck('value')->toArray();

        $categories = Category::getAssignableCategories();


        return view($this->edit_variation_view, compact(['product', 'categories', 'attributes']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      //return $request;
        //has_access('product_update');

        $validated_data = $request->validate($this->UpdateValidationRules());

        try {
            $object = $this->model_instance::find($id);
            $updated_instance = $object->update();
            if ($request->has('image')) {
                $image = $validated_data["image"];
                $img_file_path = Storage::disk('public_images')->put('products', $image);
                $image_name = $request->file('image')->getClientOriginalName();
                $image_url = getMediaUrl($img_file_path);
                $object->image_url = $image_url;
                $object->image_name = $image_name;
                $object->update();
            }
            if ($request->has('prices') ) {
                $prices = $request->prices;
                foreach ($prices as $price) {
                       if($price['size']!=null) {
                           ProductPrices::create([
                               'product_id' => $object->id,
                               'size' => $price['size'],
                               'type' => 'none',
                               'description' => 'none',
                               'price' => $price['price'],
                           ]);
                       }
                }
            }
            if ($request->has('translations')) {
                $translations = $request->translations;
                foreach ($translations as $translation) {
                    ProductTranslation::create([
                        'product_id' => $object->id,
                        'lang' => $translation['language'],
                        'name' => $translation['name'],
                        'description' => $translation['description'],
                    ]);
                }
            }
            if ($updated_instance) {

                $log_message = trans('products.update_log') . '#' . $object->id;
                UserActivity::logActivity($log_message);
                return redirect()->route($this->edit_route, $object->id)->with('success', $this->update_success_message);
            } else {
                return redirect()->route($this->index_route)->with('error', $this->update_error_message);
            }
        } catch (\Exception $ex) {
            //dd($ex->getMessage());
            Log::error($ex->getMessage());
            return redirect()->route($this->index_route)->with('error', $this->error_message);
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {

        // has_access('product_remozve');
        $deleted = $this->model_instance::findOrFail($id)->delete();
        if ($deleted) {
            $log_message = trans('products.delete_log') . '#' . $id;
            UserActivity::logActivity($log_message);
            return redirect()->route($this->index_route)->with('success', $this->update_error_message);
        } else {
            return redirect()->route($this->index_route)->with('error', $this->update_error_message);
        }
    }

    public function search(Request $request)
    {
        $term = trim($request->q);

        if (empty($term)) {
            return response()->json([]);
        }

        $products = Product::where('name', 'LIKE', '%' . $term . '%')->where(['status' => 'active', 'stock_status' => 'in', 'is_variant' => 'no'])->limit(5)->get(['id', 'name']);
        $map = $products->map(function ($items) {
            $data["id"] = $items->id;
            $data["text"] = $items->name;
            return $data;
        });

        return response()->json($map->toArray());

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

}
