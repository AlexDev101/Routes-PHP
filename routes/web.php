<?php

    use Lib\Route;
    use App\Controllers\UserController;
    use App\Controllers\HomeController;

    Route::get('/', [HomeController::class, 'index']);
    
    Route::get('/users', [UserController::class, 'index']);
    Route::get('/users/create', [UserController::class, 'create']);
    Route::post('/users', [UserController::class, 'store']);
    Route::get('/users/:id', [UserController::class, 'show']);
    Route::get('/users/:id/edit', [UserController::class, 'edit']);
    Route::post('/users/:id', [UserController::class, 'update']);
    Route::post('/users/:id/delete', [UserController::class, 'delete']);

    // Route::get('/courses/:slug', function($slug) {
    //     return "El curso se llama: " . $slug;
    // });

    Route::dispatch();

?>