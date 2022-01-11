<?php

namespace App\Observers;

use App\Models\CategorytoProductModel;
use Illuminate\Support\Facades\Cache;

class CategorytoProductObserver
{
   public function created(CategorytoProductModel $categorytoProductModel)
    {
    }

    public function updated(CategorytoProductModel $categorytoProductModel)
    {
    }

    public function deleted(CategorytoProductModel $categorytoProductModel)
    {
    }
}
