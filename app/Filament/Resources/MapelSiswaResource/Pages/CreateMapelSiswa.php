<?php

namespace App\Filament\Resources\MapelSiswaResource\Pages;

use App\Filament\Resources\MapelSiswaResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateMapelSiswa extends CreateRecord
{
    protected static string $resource = MapelSiswaResource::class;

    protected static ?string $title = 'Mapel Siswa'; 

    protected function getRedirectUrl(): string
    {
        return route('filament.admin.resources.mapel-siswas.index');
    }
}
