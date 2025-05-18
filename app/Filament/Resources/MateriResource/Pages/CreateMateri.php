<?php

namespace App\Filament\Resources\MateriResource\Pages;

use App\Filament\Resources\MateriResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateMateri extends CreateRecord
{
    protected static string $resource = MateriResource::class;

    protected static ?string $title = 'Tambah Materi Baru'; 

    protected function getRedirectUrl(): string
    {
        return route('filament.admin.resources.materis.index');
    }
}
