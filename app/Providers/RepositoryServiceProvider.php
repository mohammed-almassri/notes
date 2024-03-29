<?php

namespace App\Providers;

use App\Repositories\Notes\NotesRepository;
use App\Repositories\Notes\NotesRepositoryInterface;
use App\Repositories\Tasks\TasksRepository;
use App\Repositories\Tasks\TasksRepositoryInterface;
use App\Repositories\Users\UsersRepository;
use App\Repositories\Users\UsersRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(UsersRepositoryInterface::class, UsersRepository::class);
        $this->app->bind(NotesRepositoryInterface::class, NotesRepository::class);
        $this->app->bind(TasksRepositoryInterface::class, TasksRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
