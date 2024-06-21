<?php

namespace App\Services;

use App\Models\TelegramUser\TelegramUser;

class TelegramUserService
{
    private const DEFAULT_FIELDS = [
    ];

    public function create(array $data): TelegramUser
    {
        $telegramUser = new TelegramUser(self::DEFAULT_FIELDS);
        $telegramUser->fill($data);
        $telegramUser->balance = 0;
        $this->validate($telegramUser);
        $telegramUser->save();

        if ($telegramUser->referer) {
            $telegramUser->balance += TelegramUser::REFERRER_BALANCE_GIFT;
            $telegramUser->referer->balance += TelegramUser::REFERRER_BALANCE_GIFT;
            $telegramUser->save();
            $telegramUser->referer->save();
        }

        return $telegramUser;
    }

    public function update(TelegramUser $telegramUser, array $data): TelegramUser
    {
        $oldBalance = $telegramUser->balance;

        $telegramUser->fill($data);
        $this->validate($telegramUser);
        $telegramUser->save();

        $newBalance = $telegramUser->balance;
        $balanceChange = $newBalance - $oldBalance;

        if ($telegramUser->referer && $balanceChange > 0) {
            $refererBonus = $balanceChange * (TelegramUser::REFERRER_BALANCE_PERCENT / 100);
            $telegramUser->referer->balance += $refererBonus;
            $telegramUser->referer->save();
        }

        return $telegramUser;
    }

    public function delete(TelegramUser $telegramUser): void
    {
        // $this->canDelete($telegramUser);
        // $telegramUser->delete();
    }

    private function validate(TelegramUser $telegramUser) {
    }

    private function canDelete(TelegramUser $telegramUser) {
    }
}
