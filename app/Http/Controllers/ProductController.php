<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Models\Category;
use App\Models\Brand;
use App\Models\Location;
use App\Models\Supplier;
use App\Models\Product;

use Carbon\Carbon;

class ProductController extends Controller
{
    public function getCategory(Request $request)
    {
        $categories = Category::orderBy('name', 'asc')->get();
        $categories->makeHidden(['created_at','updated_at']);
        return response($categories, 200);
    }

    public function createCategory(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|unique:categories,name'
        ]);

        $category = Category::create([
            'name' => $data['name']
        ]);

        return response($category, 200);
    }

    public function updateCategory(Request $request, $id)
    {
        $category = Category::find($id);
        $category->update($request->all());
        return $category;
    }

    public function deleteCategory($id)
    {
        return Category::destroy($id);
    }

    // -------------------------

    public function getBrand(Request $request)
    {
        $brand = Brand::all();
        return response($brand, 200);
    }

    public function createBrand(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|unique:categories,name'
        ]);

        $brand = Brand::create([
            'name' => $data['name']
        ]);

        return response($brand, 200);
    }

    public function updateBrand(Request $request, $id)
    {
        $brand = Brand::find($id);
        $brand->update($request->all());
        return $brand;
    }

    public function deleteBrand($id)
    {
        return Brand::destroy($id);
    }

    // -------------------------

    public function getLocation(Request $request)
    {
        $location = Location::all();
        return response($location, 200);
    }

    public function createLocation(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|unique:categories,name'
        ]);

        $location = Location::create([
            'name' => $data['name']
        ]);

        return response($location, 200);
    }

    public function updateLocation(Request $request, $id)
    {
        $location = Location::find($id);
        $location->update($request->all());
        return $location;
    }

    public function deleteLocation($id)
    {
        return Location::destroy($id);
    }

    // -------------------------

    public function getSupplier(Request $request)
    {
        $supplier = Supplier::all();
        return response($supplier, 200);
    }

    public function createSupplier(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|unique:categories,name'
        ]);

        $supplier = Supplier::create([
            'name' => $data['name']
        ]);

        return response($supplier, 200);
    }

    public function updateSupplier(Request $request, $id)
    {
        $supplier = Supplier::find($id);
        $supplier->update($request->all());
        return $supplier;
    }

    public function deleteSupplier($id)
    {
        return Supplier::destroy($id);
    }

    // -------------------------

    /*
        'name',
        'model',
        'price',
        'discount_price',
        'base_price',
        'quantity_shop',
        'quantity_warehouse',
        'location_id',
        'category_id',
        'brand_id',
        'supplier_id',
        'date_input',
        'sold'
    */
    
    public function createProduct(Request $request)
    {
        $inputTime = Carbon::now();
        $inputTime = $inputTime->format('d-m-y H:i');

        $data = $request->validate([
            'name' => 'required|string',
            'model' => 'required|string|unique:products,model',
            'price' => 'required|integer|gt:0',
            'discount_price' => 'required|integer',
            'base_price' => 'required|integer',
            'quantity_shop' => 'required|integer',
            'quantity_warehouse' => 'required|integer',
            'location_id' => 'required|integer',
            'category_id' => 'required|integer',
            'brand_id' => 'required|integer',
            'supplier_id' => 'required|integer',
            'supplier_model' => 'required|string'
        ]); 
        
        $product = Product::create([
            'name' => $data['name'],
            'model' => $data['model'],

            'category_id' => $data['category_id'],
            'location_id' => $data['location_id'],
            'brand_id' => $data['brand_id'],
            'supplier_id' => $data['supplier_id'],
            'supplier_model' => $data['supplier_model'],

            'price' => $data['price'],
            'discount_price' => $data['discount_price'],
            'base_price' => $data['base_price'],
            'quantity_shop' => $data['quantity_shop'],
            'quantity_warehouse' => $data['quantity_warehouse'],
            'tanggal_masuk' => $inputTime
            
        ]);

        return response($product, 200);
    }

    public function getProducts(Request $request)
    {
        $products = Product::orderBy('id', 'desc')->paginate(5);

        return $products;
    }

    public function deleteProduct($id)
    {
        return Product::destroy($id);
    }

    public function updateProduct(Request $request, $id)
    {
        $product = Product::find($id);
        $product->update($request->all());
        return $product;
    }

    public function findProduct(Request $request)
    {
        $inputModel = $request['model'];
        $inputModel = trim(preg_replace('/\s+/', ' ', $inputModel));

        $model = Product::where("model", "LIKE", "%" . $inputModel . "%");
        return $model->get();
    }

    public function findModel(Request $request)
    {
        $inputModel = $request['model'];
        $inputModel = trim(preg_replace('/\s+/', ' ', $inputModel));

        $model = Product::where("model", "=", $inputModel );
        return $model->get();
    }

    public function getProductsByCategory(Request $request, $id)
    {
        $products = Product::where("category_id", "=", $id)->get();

        return $products;
    }

    public function getProductsByLocation(Request $request, $id)
    {
        $products = Product::where("location_id", "=", $id)->get();

        return $products;
    }

}
