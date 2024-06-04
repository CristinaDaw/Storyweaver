<?php

use App\Http\Controllers\CharacterController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ConversationSummaryController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EventController;
use App\Models\Character;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/how-to', function () {
    return view('how-to');
})->name('how-to');


Route::middleware(['auth', 'verified'])->group(function () {
    // Ruta del dashboard para usuarios normales
    Route::middleware('roleUser')->group(function () {
        Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('dashboard');
    });

    // Ruta del dashboard para administradores
    Route::middleware('roleAdmin')->group(function () {
        Route::get('/dashboard/admin', function () {
            return view('dashboard-admin');
        })->name('dashboard.admin');
    });
});


Route::middleware(['auth', 'checkOwnership'])->group(function () {
    // Perfil del usuario
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
    });

    // Personajes
    Route::prefix('character')->name('character.')->group(function () {
        Route::get('/create/{game_id}', [CharacterController::class, 'create'])->name('create');
        Route::post('/store', [CharacterController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [CharacterController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [CharacterController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [CharacterController::class, 'destroy'])->name('destroy');
    });

    // Juegos
    Route::prefix('game')->name('game.')->group(function () {
        Route::get('/{game_id}', [GameController::class, 'show'])->name('show');
        Route::get('/chat/{game_id}', [GameController::class, 'resume'])->name('resume');
        Route::delete('/delete/{game_id}', [GameController::class, 'destroy'])->name('destroy');
        Route::patch('/finish/{game_id}', [GameController::class, 'finish'])->name('finish');
        Route::post('/store', [GameController::class, 'store'])->name('store');
    });

    // History
    Route::prefix('api')->name('api.')->group(function () {
        Route::get('/chat-history/{game_id}', [ChatController::class, 'getChatHistory'])->name('chat-history');
        Route::post('/persist-context', [ChatController::class, 'persistContext'])->name('persist-context');
        Route::post('/send-message', [ChatController::class, 'sendMessage'])->name('send-message');
        Route::post('/generate-image', [ChatController::class, 'generateImage'])->name('generate-image');

    });

    // ConversationSummary
    Route::prefix('conversation_summary')->name('conversation_summary.')->group(function () {
        Route::get('/{game_id}', [ConversationSummaryController::class, 'get'])->name('get');
        Route::post('/{game_id}', [ConversationSummaryController::class, 'store'])->name('store');
    });

    // Eventos
    Route::prefix('event')->name('event.')->group(function () {
        Route::get('/store/initial/{character_id}', [EventController::class, 'storeInitialEvent'])->name('store.initial');
        Route::get('/store/ending/{game_id}', [EventController::class, 'storeEndingEvent'])->name('store.ending');
    });

});


Route::middleware(['auth', 'roleAdmin'])->group(function () {
    // Rutas de usuarios
    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/show/{name}', [UserController::class, 'indexByName'])->name('users.show');
        Route::get('/edit/{user_id}', [UserController::class, 'edit'])->name('edit');
        Route::patch('/update/{user_id}', [UserController::class, 'update'])->name('update');
        Route::delete('/delete/{user_id}', [UserController::class, 'destroy'])->name('destroy');
    });

    // Rutas de roles
    Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
    Route::get('/roles/show/{id}', [RoleController::class, 'indexByID'])->name('users.show');

    // Rutas de personajes
    Route::get('/characters', [CharacterController::class, 'index'])->name('characters.index');
    Route::get('/characters/show/{name}', [CharacterController::class, 'indexByName'])->name('users.show');

    // Rutas de juegos
    Route::get('/games', [GameController::class, 'index'])->name('games.index');
    Route::get('/games/show/{id}', [GameController::class, 'indexByID'])->name('users.show');
});









require __DIR__.'/auth.php';
