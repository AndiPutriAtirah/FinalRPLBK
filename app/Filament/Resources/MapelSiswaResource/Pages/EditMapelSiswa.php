<?php

namespace App\Filament\Resources\MapelSiswaResource\Pages;

use App\Filament\Resources\MapelSiswaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMapelSiswa extends EditRecord
{
    protected static string $resource = MapelSiswaResource::class;

    protected static ?string $title = 'Edit Mapel Siswa'; 

    protected function getRedirectUrl(): string
    {
        return route('filament.admin.resources.mapel-siswas.index');
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
