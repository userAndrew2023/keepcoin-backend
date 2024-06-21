<?php

namespace App\Http\Controllers;

use App\Models\TelegramUser;
use App\Services\TelegramUserService;
use Illuminate\Http\Request;

class TelegramUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return TelegramUser::all();
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id, Request $request)
    {
        $type = null;
        if ($request->get("type")) {
            $type = $request->get("type");
        }
        return $this->find($id, $type);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, TelegramUserService $telegramUserService)
    {
        return $telegramUserService->create($request->all());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id, TelegramUserService $telegramUserService)
    {
        return $telegramUserService->update($this->find($id), $request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id, TelegramUserService $telegramUserService)
    {
        return $telegramUserService->delete($this->find($id));
    }

    private function find(int $id, ?string $type = null) {
        $query = TelegramUser::query();
        switch ($type) {
            case "telegram":
                $query->where("telegram_id", $id);
                break;
            default:
                $query->where("id", $id);
        }
        return $query->first();
    }
}
