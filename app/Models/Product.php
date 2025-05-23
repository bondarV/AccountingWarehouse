<?php

namespace App\Models;

use Database\Factories\ProductFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    /** @use HasFactory<ProductFactory> */
    use HasFactory;

    public function occurrences(): hasMany
    {
        return $this->hasMany(Inventory::class);
    }

    public function total_quantity(): int|float{
        return $this->occurrences()->sum('quantity');
    }
    public function warehouses(): BelongsToMany
    {
        return $this->belongsToMany(Warehouse::class, 'inventory')->withPivot('quantity');
    }
}
