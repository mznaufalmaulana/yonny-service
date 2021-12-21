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
    return DB::table('tbl_product as tpd')
            ->join('ms_product_type as mpt', 'tpd.product_type_id', 'mpt.id')
            ->select(
              'tpd.id', 'mpt.type_name', 'tpd.product_name',
              'tpd.product_slug', 'tpd.is_active', 'tpd.seen_count',
              'tpd.share_count'
            )
            ->get();
  }

  public function getListProductStoreRepo()
  {
    return DB::table('tbl_product as tpd')
            ->join('ms_product_type as mpt', 'tpd.product_type_id', '=', 'mpt.id')
            ->join('brg_product_category as bpc', 'tpd.id','=', 'bpc.product_id')
            ->join('ms_category as mc', 'bpc.category_id', '=', 'mc.id')
            ->select(
              'tpd.id', 'tpd.product_name',
              'tpd.product_slug', 'tpd.is_active',
              DB::raw('(select tpp.photo_name from tbl_product_photo tpp where tpd.id = tpp.product_id limit 1) as photo_name')
            )
            ->distinct()
            ->where('tpd.is_active','=', Config::get('constants_val.active'));
  }

  public function queryProductName($query, $name)
  {
    return $query->where('tpd.product_name', 'like', "%$name%");
  }

  public function queryCategory($query, $categoryId)
  {
    return $query->whereIn('mc.id', $categoryId);
  }

  public function queryType($query, $typrId)
  {
    return $query->where('mpt.id', $typrId);
  }

  public function querySort($query, $sort)
  {
    return $query->orderBy('tpd.product_name', $sort);
  }

  public function queryPaging($query)
  {
    return $query->paginate(Config::get('constants_val.product_paging_limit'));
  }


  public function getListLatestProductRepo()
  {
    return DB::table('tbl_product as tpd')
            ->select('tpd.id', 'tpd.product_name',
              DB::raw('(select tpp.photo_name from tbl_product_photo tpp where tpd.id = tpp.product_id limit 1) as photo_name')
            )
            ->orderBy('tpd.id','DESC')
            ->limit(Config::get('constants_val.latest_product_limit'))
            ->get();
  }

  //Get Product
  public function getProductByIdRepo($id)
  {
    return DB::table('tbl_product as tpd')
            ->join('ms_product_type as mpt', 'tpd.product_type_id', 'mpt.id')
            ->where('tpd.id', $id)
            ->where('tpd.is_active','=', Config::get('constants_val.active'))
            ->select(
              'tpd.id','mpt.id as type_id','mpt.type_name', 'tpd.product_name',
              'tpd.product_slug', 'tpd.description', 'tpd.is_active',
              'tpd.seen_count', 'tpd.share_count'
            )
            ->get();
  }

  public function getListProductByCategoryIdRepo($id)
  {
    return DB::table('brg_product_category as bpc')
            ->join('tbl_product as tp', 'bpc.product_id', '=', 'tp.id')
            ->where('bpc.category_id', $id)
            ->where('tp.is_active','=', Config::get('constants_val.active'))
            ->select('tp.id','tp.product_name', 'tp.product_slug',
              DB::raw('(select tpp.photo_name from tbl_product_photo tpp where tp.id = tpp.product_id limit 1) as photo_name')
            )
            ->get();
  }

  public function getProductPhotoByProductIdRepo($id)
  {
    return DB::table('tbl_product_photo')
            ->where('product_id', $id)
            ->select('id', 'photo_name')
            ->get();
  }

  public function getProductPhotoByIdRepo($id)
  {
    return ProductPhotoModel::where('id', $id)
            ->select('id', 'photo_name')
            ->get();
  }

  //Store Product
  public function storeProductRepo($request)
  {
    return ProductModel::create([
              'product_type_id' =>  $request->product_type_id,
              'product_name' => $request->product_name,
              'product_slug' => \Str::slug($request->product_name,'-'),
              'description' => $request->description,
              'is_active' =>  $request->is_active,
              'seen_count' =>  Config::get('constants_val.count_start'),
              'share_count' =>  Config::get('constants_val.count_start')
            ]);
  }

  public function storeCategoryOfProductRepo($category_id, $product_id)
  {
    return CategorytoProductModel::create([
              'category_id' =>  $category_id,
              'product_id'  =>  $product_id,
            ]);
  }

  public function storeProductPhotoRepo($productId, $productPhotoName)
  {
    return ProductPhotoModel::create([
              'product_id'  =>  $productId,
              'photo_name'  =>  $productPhotoName
            ]);
  }

  //Update Product
  public function updateProductRepo($id, $request)
  {
    return ProductModel::where('id', $id)->update([
      'product_type_id' =>  $request->product_type_id,
      'product_name' => $request->product_name,
      'product_slug' => \Str::slug($request->product_name,'-'),
      'description' => $request->description,
      'is_active' =>  $request->is_active,
      'seen_count' =>  $request->seen_count,
      'share_count' =>  $request->share_count
    ]);
  }

  public function updateProductPhotoRepo($id, $productPhotoName)
  {
    return ProductPhotoModel::where('id', $id)
            ->update([ 'photo_name'  =>  $productPhotoName]);
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