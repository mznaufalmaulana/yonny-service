<?php


namespace App\Repositories;


use App\Http\Requests\PhotoRequest;
use App\Http\Requests\ProductRequest;
use App\Models\CategorytoProductModel;
use App\Models\ProductModel;
use App\Models\ProductPhotoModel;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class ProductRepository
{
  //List Product
  public function getListProductRepo()
  {
    $products = DB::table('tbl_product as tpd')
                ->join('ms_product_type as mpt', 'tpd.product_type_id', 'mpt.id')
                ->select(
                  'tpd.id', 'mpt.type_name', 'tpd.product_name',
                  'tpd.is_active', 'tpd.share_count'
                )->get();
    return $products;
  }

  //Get Product
  public function getProductByIdRepo($id)
  {
    $product = DB::table('tbl_product as tpd')
                ->join('ms_product_type as mpt', 'tpd.product_type_id', 'mpt.id')
                ->where('tpd.id', $id)
                ->select(
                  'tpd.id', 'mpt.id as product_type_id',
                  'tpd.product_name', 'tpd.description', 'tpd.is_active',
                  'tpd.share_count'
                )->get();
    return $product;
  }

  public function getCategoryProductByProductId($id)
  {
    return DB::table('brg_product_category as bpc')
            ->join('ms_category as mc', 'mc.id', 'bpc.category_id')
            ->where('bpc.product_id', $id)
            ->select('mc.id', 'mc.category_name')
            ->get();
  }

  public function getProductPhotoByProductIdRepo($id)
  {
    return DB::table('tbl_product_photo')->where('product_id', $id)->select(
      'id', 'photo_name'
    )->get();
  }

  public function getProductPhotoByIdRepo($id)
  {
    return ProductPhotoModel::where('id', $id)->select(
      'id', 'photo_name'
    )->get();
  }

  //Store Product
  public function storeProductRepo(ProductRequest $request)
  {
      $product = ProductModel::create([
        'product_type_id' =>  $request->product_type_id,
        'product_name' => $request->product_name,
        'product_slug' => \Str::slug($request->product_name,'-'),
        'description' => $request->description,
        'is_active' =>  $request->is_active,
        'share_count' =>  Config::get('constants_val.count_start')
      ]);
      return $product;
  }

  public function storeCategoryOfProductRepo($category_id, $product_id)
  {
    $result = CategorytoProductModel::create([
      'category_id' =>  $category_id,
      'product_id'  =>  $product_id,
    ]);
    return $result;
  }

  public function storeProductPhotoRepo($productId, $productPhotoName)
  {
    return ProductPhotoModel::create([
      'product_id'  =>  $productId,
      'photo_name'  =>  $productPhotoName
    ]);
  }

  //Update Product
  public function updateProductRepo($id, ProductRequest $request)
  {
    return ProductModel::where('id', $id)->update([
      'product_type_id' =>  $request->product_type_id,
      'product_name' => $request->product_name,
      'product_slug' => \Str::slug($request->product_name,'-'),
      'description' => $request->description,
      'is_active' =>  $request->is_active,
      'share_count' =>  $request->share_count
    ]);
  }

  public function updateProductPhotoRepo($id, $productPhotoName)
  {
    return ProductPhotoModel::where('id', $id)->update([ 'photo_name'  =>  $productPhotoName]);
  }

  //Delete Product
  public function deleteProductRepo($id)
  {
    return ProductModel::destroy($id);
  }

  public function deleteCategoryOfProductByProductRepo($id)
  {
    return CategorytoProductModel::where('product_id', $id)->delete();
  }

  public function deleteProductPhotoByProductRepo($productId)
  {
    return ProductPhotoModel::where('product_id', $productId)->delete();
  }

  public function deleteProductPhotoByIdRepo($id)
  {
    return ProductPhotoModel::destroy($id);
  }

  public function isProductExist($id)
  {
    return ProductModel::findOrFail($id);
  }

}