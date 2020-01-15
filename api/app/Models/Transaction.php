<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    public $timestamps = false;

    const STATUS_CODE_AUTHORISED = 'authorised';
    const STATUS_CODE_DECLINE = 'decline';
    const STATUS_CODE_REFUNDED = 'refunded';

    const PROVIDER_FLYPAY_A = 'flypayA';
    const PROVIDER_FLYPAY_B = 'flypayB';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'provider',
        'amount',
        'currency',
        'status_code',
        'order_reference',
        'transaction_id',
    ];

    /**
     * Gets a list of the available status code.
     *
     * @return array
     */
    public static function getStatusCodeList()
    {
        return [
            self::STATUS_CODE_AUTHORISED,
            self::STATUS_CODE_DECLINE,
            self::STATUS_CODE_REFUNDED,
        ];
    }
}
