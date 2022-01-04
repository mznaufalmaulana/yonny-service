<?php

namespace App\Observers;

use App\Models\PromoModel;
use Illuminate\Support\Facades\Cache;

class PromoObserver
{
    public function created(PromoModel $promoModel)
    {
      Cache::forget('promoHeadline');
      Cache::forget('promoNonHeadline');
    }

    public function updated(PromoModel $promoModel)
    {
      Cache::forget('promoHeadline');
      Cache::forget('promoNonHeadline');
    }

    /**
     * Handle the promo model "deleted" event.
     *
     * @param  \App\Models\PromoModel  $promoModel
     * @return void
     */
    public function deleted(PromoModel $promoModel)
    {
      Cache::forget('promoHeadline');
      Cache::forget('promoNonHeadline');
    }
}
