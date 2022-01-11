<?php

namespace App\Observers;

use App\Models\ProductModel;
use Illuminate\Support\Facades\Cache;

class ProductObserver
{
    public function created(ProductModel $productModel)
    {
    }

    public function updated(ProductModel $productModel)
    {
    }

    public function deleted(ProductModel $productModel)
    {
    }

}
