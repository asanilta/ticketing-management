<?php

use Spatie\Permission\Middleware\RoleMiddleware;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\UserManagementController;

Route::get('/', function () {
    // Check if the user is authenticated
    if (Auth::check()) {
        // Redirect based on the user's role
        $user = Auth::user();
        if ($user->hasRole('admin')) {
            return redirect()->route('admin.tickets.index');
        } elseif ($user->hasRole('agent')) {
            return redirect()->route('agent.tickets.index');
        } elseif ($user->hasRole('customer')) {
            return redirect()->route('tickets.index');
        }
    }

    // Default page for unauthenticated users
    return view('home');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Customer routes
Route::middleware(['role:customer'])->group(function () {
    Route::get('/tickets', [TicketController::class, 'index'])->name('tickets.index'); // View their tickets
    Route::get('/tickets/create', [TicketController::class, 'create'])->name('tickets.create'); // Ticket creation form
    Route::post('/tickets', [TicketController::class, 'store'])->name('tickets.store'); // Submit a ticket
    Route::put('/tickets/{ticket}', [TicketController::class, 'updateStatus'])->name('tickets.update'); // Close a ticket
});

// Admin routes
Route::middleware(['role:admin'])->group(function () {
    Route::get('/admin/users', [UserManagementController::class, 'index'])->name('admin.users.index'); // View all users
    Route::get('/admin/users/create', [UserManagementController::class, 'create'])->name('admin.users.create'); // User creation form
    Route::post('/admin/users', [UserManagementController::class, 'store'])->name('admin.users.store'); // Create new user
    Route::delete('/admin/users/{user}', [UserManagementController::class, 'destroy'])->name('admin.users.destroy'); // Delete user
    Route::get('/admin/tickets', [TicketController::class, 'adminIndex'])->name('admin.tickets.index'); // View all tickets
    Route::put('/admin/tickets/{ticket}/assign', [TicketController::class, 'assign'])->name('admin.tickets.assign'); // Assign a ticket to an agent
    Route::put('/admin/tickets/{ticket}', [TicketController::class, 'updateStatus'])->name('admin.tickets.update'); // Update any ticket
    Route::delete('/admin/tickets/{ticket}', [TicketController::class, 'destroy'])->name('admin.tickets.destroy'); // Delete any ticket
});

// Agent routes
Route::middleware(['role:agent'])->group(function () {
    Route::get('/agent/tickets', [TicketController::class, 'agentIndex'])->name('agent.tickets.index'); // View tickets assigned to them
    Route::put('/agent/tickets/{ticket}', [TicketController::class, 'updateStatus'])->name('agent.tickets.update'); // Update tickets assigned to them
});


// Include Auth Scaffolding from Breeze
require __DIR__.'/auth.php';