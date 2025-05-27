<?php

namespace App\Models;

use App\Observers\PurchaseObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
#[ObservedBy([PurchaseObserver::class])]

class Purchase extends Model
{
    use HasUlids;

    public function product() : BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
    public function warehouse(): BelongsTo
    {
        return $this->belongsTo(Warehouse::class);
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    protected $guarded = [];
}
