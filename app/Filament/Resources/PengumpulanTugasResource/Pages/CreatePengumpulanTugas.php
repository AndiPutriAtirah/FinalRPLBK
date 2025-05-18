<?php

namespace App\Filament\Resources\PengumpulanTugasResource\Pages;

use App\Filament\Resources\PengumpulanTugasResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePengumpulanTugas extends CreateRecord
{
    protected static string $resource = PengumpulanTugasResource::class;

    protected static ?string $title = 'Kumpulkan Tugas'; 

    protected function getRedirectUrl(): string
    {
        return route('filament.admin.resources.pengumpulan-tugas.index');
    }
    
}
