<?php

namespace App\Policies;

use App\Models\Event;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class EventPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true; // Разрешаем просмотр списка событий
    }

    public function view(User $user, Event $event): bool
    {
        return $user->id === $event->user_id;
    }

    public function create(User $user): bool
    {
        return true; // Разрешаем создание событий для авторизованных
    }

    public function update(User $user, Event $event): bool
    {
        return $user->id === $event->user_id;
    }

    public function delete(User $user, Event $event): bool
    {
        return $user->id === $event->user_id;
    }

    public function restore(User $user, Event $event): bool
    {
        return false; // Отключаем восстановление
    }

    public function forceDelete(User $user, Event $event): bool
    {
        return false; // Отключаем полное удаление
    }
}
