<?php

namespace App\Providers;

use App\Repositories\Account\AccountRepository;
use App\Repositories\Account\AccountRepositoryInterface;
use App\Repositories\Board\BoardRepository;
use App\Repositories\Board\BoardRepositoryInterface;
use App\Repositories\Task\TaskRepository;
use App\Repositories\Task\TaskRepositoryInterface;
use App\Repositories\Workspace\WorkspaceRepository;
use App\Repositories\Workspace\WorkspaceRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(AccountRepositoryInterface::class, AccountRepository::class);
        $this->app->bind(WorkspaceRepositoryInterface::class, WorkspaceRepository::class);
        $this->app->bind(BoardRepositoryInterface::class, BoardRepository::class);
        $this->app->bind(TaskRepositoryInterface::class, TaskRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
