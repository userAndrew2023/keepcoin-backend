<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TelegramUserTask extends Model
{
    public const STATUS_STARTED = "started";
    public const STATUS_VERIFED = "verifed";
    public const STATUS_CLAIMED = "claimed";

    protected $fillable = [
        'telegram_user_id',
        'task_id',
        'status',
    ];

    public function telegramUser(): BelongsTo
    {
        return $this->belongsTo(TelegramUser::class);
    }

    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }
}
