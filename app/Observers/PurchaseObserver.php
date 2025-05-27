<?php

namespace App\Observers;

use App\Models\Purchase;
use App\Notifications\PurchaseCreatedNotification;

class PurchaseObserver
{
    /**
     * Handle the Purchase "created" event.
     */
    public function created(Purchase $purchase): void
    {
        $user = $purchase->user()->first();
        if($user){
            $user->notify(new PurchaseCreatedNotification($purchase));
        }
    }

    /**
     * Handle the Purchase "updated" event.
     */
    public function updated(Purchase $purchase): void
    {
        //
    }

    /**
     * Handle the Purchase "deleted" event.
     */
    public function deleted(Purchase $purchase): void
    {
        //
    }

    /**
     * Handle the Purchase "restored" event.
     */
    public function restored(Purchase $purchase): void
    {
        //
    }

    /**
     * Handle the Purchase "force deleted" event.
     */
    public function forceDeleted(Purchase $purchase): void
    {
        //
    }
}
