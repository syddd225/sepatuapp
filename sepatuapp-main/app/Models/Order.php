<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_id',
        'user_id',
        'product_id',
        'qty',
        'ukuran',
        'warna',
        'shipping_tier',
        'shipping_name',
        'base_delivery_fee',
        'shipping_tier_fee',
        'total_shipping_cost',
        'use_voucher',
        'voucher_discount',
        'payment_method',
        'grand_total',
    ];

    protected $casts = [
        'qty' => 'integer',
        'use_voucher' => 'boolean',
        'base_delivery_fee' => 'decimal:2',
        'shipping_tier_fee' => 'decimal:2',
        'total_shipping_cost' => 'decimal:2',
        'voucher_discount' => 'decimal:2',
        'grand_total' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the user that placed the order.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the product ordered.
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
