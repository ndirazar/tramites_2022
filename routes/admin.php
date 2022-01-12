<?php

use App\Http\Livewire\Analytics;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Admin\Users\ListUsers;
use App\Http\Livewire\Admin\Profile\UpdateProfile;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Livewire\Admin\Appointments\ListAppointments;
use App\Http\Livewire\Admin\Appointments\CreateAppointmentForm;
use App\Http\Livewire\Admin\Appointments\UpdateAppointmentForm;
use App\Http\Livewire\Admin\Inicio;
use App\Http\Livewire\Admin\Settings\UpdateSetting;
use App\Http\Livewire\Dependencias\DependenciaList;
use App\Http\Livewire\Dependencias\DependenciaUsers;
use App\Http\Livewire\Notas\NotaCreate;
use App\Http\Livewire\Notas\NotasEdit;
use App\Http\Livewire\Notas\NotasList;
use App\Http\Livewire\Notas\NotasShow;

Route::get('dashboard', DashboardController::class)->name('dashboard');

Route::get('inicio', Inicio::class)->name('inicio');

Route::get('users', ListUsers::class)->name('users');

Route::get('appointments', ListAppointments::class)->name('appointments');

Route::get('appointments/create', CreateAppointmentForm::class)->name('appointments.create');

Route::get('appointments/{appointment}/edit', UpdateAppointmentForm::class)->name('appointments.edit');

Route::get('profile', UpdateProfile::class)->name('profile.edit');

Route::get('dependencias', DependenciaList::class)->name('dependencias');

Route::get('dependencia-user', DependenciaUsers::class)->name('dependencias.user');

Route::get('notas', NotaCreate::class)->name('notas.create');

Route::get('notas-list', NotasList::class)->name('notas.list');

Route::get('notas-show/{idNota}', NotasShow::class)->name('notas.show');

Route::get('notas-edit/{idNota}', NotasEdit::class)->name('notas.edit');

Route::get('analytics', Analytics::class)->name('analytics');

Route::get('settings', UpdateSetting::class)->name('settings');
