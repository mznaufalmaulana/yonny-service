<?php

namespace App\Observers;

use App\Models\ProductCategoryModel;
use Illuminate\Support\Facades\Cache;

class ProductCategoryObserver
{
    public function created(ProductCategoryModel $productCategoryModel)
    {
    }

    public function updated(ProductCategoryModel $productCategoryModel)
    {
    }

    public function deleted(ProductCategoryModel $productCategoryModel)
    {
    }
}
