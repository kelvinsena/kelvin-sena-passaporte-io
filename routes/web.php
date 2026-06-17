<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;         
use App\Http\Controllers\AuthController;
use App\Models\Event;

//portal publico
Route::get('/', function () {
    if (Auth::check()) {
        $user = Auth::user();

        if ($user->role === 'organizador') {
            return redirect()->route('admin.events.index');
        }

        if ($user->role === 'participante') {
            return redirect()->route('participante.tickets');
        }
    }
    return view('home'); 
})->name('home');

// autenticacao visitantes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    
    Route::get('/cadastro', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/cadastro', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

//--------------------- area do participante ---------------------------------

Route::middleware(['auth', 'role:participante'])->group(function () {
    
    // eventos 
    Route::get('/meus-ingressos', function () {
        $eventos = Event::all(); 
        
        $meusEventosIds = DB::table('event_user')
            ->where('user_id', Auth::id())
            ->pluck('event_id')
            ->toArray();

        return view('participante-tickets', compact('eventos', 'meusEventosIds')); 
    })->name('participante.tickets');

    Route::post('/eventos/{id}/inscrever', function ($id) {
        $jaInscrito = DB::table('event_user')
            ->where('user_id', Auth::id())
            ->where('event_id', $id)
            ->exists();

        if (!$jaInscrito) {
            DB::table('event_user')->insert([
                'user_id'     => Auth::id(),
                'event_id'    => $id,
                'ticket_code' => 'TCK-' . strtoupper(\Illuminate\Support\Str::random(8)),
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);
            return redirect()->back()->with('status', 'Inscrição realizada com sucesso! Seu ingresso está garantido.');
        }

        return redirect()->back()->with('error', 'Você já está inscrito neste evento.');
    })->name('events.subscribe');

    //cancelar inscri
    Route::delete('/eventos/{id}/cancelar', function ($id) {
        DB::table('event_user')
            ->where('user_id', Auth::id())
            ->where('event_id', $id)
            ->delete();

        return redirect()->back()->with('status', 'Sua inscrição foi cancelada.');
    })->name('events.unsubscribe');
});

// CRUD
Route::middleware(['auth', 'role:organizador'])->prefix('admin')->group(function () {
    
    //eventos
    Route::get('/eventos', function () {
        $eventos = Event::all(); 
        return view('admin-index', compact('eventos')); 
    })->name('admin.events.index');

    // forms
    Route::get('/eventos/criar', function () {
        return view('admin-create'); 
    })->name('admin.events.create');
    
    // salva no bbanco
    Route::post('/eventos', function (Request $request) {
        Event::create([
            'user_id'     => Auth::id(),
            'title'       => $request->title,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'date_time'   => $request->date_time,
            'capacity'    => $request->capacity,
            'location'    => $request->location,
            'banner_path' => 'banners/default.jpg', 
        ]);

        return redirect()->back()->with('status', 'Evento publicado com sucesso!');
    })->name('admin.events.store');

    // forms p edicao
    Route::get('/eventos/{id}/editar', function ($id) {
        $evento = Event::findOrFail($id);
        return view('admin-edit', compact('evento'));
    })->name('admin.events.edit');
    
    //atualiza
    Route::put('/eventos/{id}', function (Request $request, $id) {
        $evento = Event::findOrFail($id);
        $evento->update([
            'title'       => $request->title,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'date_time'   => $request->date_time,
            'capacity'    => $request->capacity,
            'location'    => $request->location,
        ]);

        return redirect()->route('admin.events.index')->with('status', 'Evento atualizado com sucesso!');
    })->name('admin.events.update');

    //excluir evento
    Route::delete('/eventos/{id}', function ($id) {
        $evento = Event::findOrFail($id);
        $evento->delete();

        return redirect()->back()->with('status', 'Evento excluído com sucesso!');
    })->name('admin.events.destroy');
});