<?php

namespace App\Filament\Resources\TugasResource\Pages;

use App\Filament\Resources\TugasResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTugas extends CreateRecord
{
    protected static string $resource = TugasResource::class;

    protected static ?string $title = 'Buat Tugas Baru'; 

    protected function getRedirectUrl(): string
    {
        return route('filament.admin.resources.tugas.index');
    }
}
