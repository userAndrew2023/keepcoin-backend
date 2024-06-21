<?php

namespace App\Http\Controllers;

use App\Models\TelegramUserTask;
use App\Services\TelegramUserTaskService;
use Illuminate\Http\Request;

class TelegramUserTaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(int $userId)
    {
        return TelegramUserTask::query()->where("user_id", $userId)->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, TelegramUserTaskService $telegramUserTaskService)
    {
        return $telegramUserTaskService->create($request->all());
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateStatus(Request $request, int $id, TelegramUserTaskService $telegramUserTaskService)
    {
        return $telegramUserTaskService->updateStatus($this->find($id), $request->get("status"));
    }

    private function find(int $id) {
        return TelegramUserTask::query()->findOrFail($id);
    }
}
