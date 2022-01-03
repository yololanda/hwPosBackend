<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Models\Category;
use App\Models\Brand;
use App\Models\Location;
use App\Models\Supplier;

class ProductController extends Controller
{
    public function getCategory(Request $request)
    {
        $categories = Category::all();
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
    // create Product
}
