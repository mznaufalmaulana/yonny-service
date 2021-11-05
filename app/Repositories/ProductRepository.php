<?php


namespace App\Repositories;


use App\Http\Requests\ProductRequest;
use App\Models\CategorytoProductModel;
use App\Models\ProductModel;
use App\Models\ProductPhotoModel;
use Illuminate\Support\Facades\DB;

class ProductRepository
{
  //List Product
  public function getListProductRepo()
  {
    $products = DB::table('tbl_product as tpd')
                ->join('ms_product_type as mpt', 'tpd.product_type_id', 'mpt.id')
                ->join('brg_product_category as bpc', 'tpd.id', 'bpc.product_id')
                ->join('ms_category as mc', 'bpc.category_id', 'mc.id')
                ->select(
                  'tpd.id', 'mc.category_name', 'mpt.type_name',
                  'tpd.is_active', 'tpd.share_count'
                )->get();
    return $products;
  }

  //Get Product
  public function getProductByIdRepo($id)
  {
//    return ProductModel::findOrFail($id, [
//      'id', 'product_type_id',
//      'product_name', 'share_count', 'is_active']);

    $product = DB::table('tbl_product as tpd')
                ->join('ms_product_type as mpt', 'tpd.product_type_id', 'mpt.id')
                ->join('tbl_product_photo as tpp', 'tpd.id', 'tpp.product_id')
                ->join('brg_product_category as bpc', 'tpd.id', 'bpc.product_id')
                ->join('ms_category as mc', 'bpc.category_id', 'mc.id')
                ->where('tpd.id', $id)
                ->select(
                  'tpd.id', 'mc.id as category_id', 'mpt.id as product_type_id',
                  'tpd.product_name', 'tpd.description', 'tpd.is_active',
                  'tpd.share_count', 'tpp.photo_name'
                )->get();
    return $product;
  }

  public function getProductPhotoByProductIdRepo($id)
  {
    return ProductPhotoModel::where('product_id', $id)->select(
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
        'description' => $request->description,
        'is_active' =>  $request->is_active,
        'share_count' =>  $request->share_count
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
    return ProductModel::where('id', $id)->update($request->validationData());
  }

  public function updateProductPhoto($id)
  {

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