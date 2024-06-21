<?php

namespace App\Models\TelegramUser;

use Illuminate\Database\Eloquent\Model;

class TelegramUser extends Model
{
    public const REFERRER_BALANCE_GIFT = 1000;
    public const REFERRER_BALANCE_PERCENT = 40;

    protected $fillable = [
        'telegram_id',
        'telegram_username',
        'referral_id',
        'balance',
    ];

    public function referer() {
        return $this->belongsTo(self::class, 'referral_id');
    }
}
