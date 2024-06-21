<?php

namespace App\Services;

use App\Models\TelegramUserTask;

class TelegramUserTaskService
{
    private const DEFAULT_FIELDS = [
        "status" => TelegramUserTask::STATUS_STARTED
    ];

    public function create(array $data): TelegramUserTask
    {
        $telegramUserTask = new TelegramUserTask(self::DEFAULT_FIELDS);
        $telegramUserTask->fill($data);
        $this->validate($telegramUserTask);
        $telegramUserTask->save();

        return $telegramUserTask;
    }

    public function updateStatus(TelegramUserTask $telegramUserTask, string $status): TelegramUserTask
    {
        switch ($status) {
            case TelegramUserTask::STATUS_VERIFED:
                // TODO сделать проверку подписки
                $telegramUserTask->status = TelegramUserTask::STATUS_VERIFED;                
                $telegramUserTask->save();
                break;
            case TelegramUserTask::STATUS_CLAIMED:
                $telegramUserTask->telegramUser->balance += $telegramUserTask->task->reward;
                $telegramUserTask->status = $status;
                $telegramUserTask->telegramUser->save();
                $telegramUserTask->save();
                break;
        }
        return $telegramUserTask;
    }

    private function validate(TelegramUserTask $telegramUserTask) {
    }
}
