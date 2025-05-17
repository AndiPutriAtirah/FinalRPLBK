<?php

namespace App\Filament\Resources\MapelSiswaResource\Pages;

use App\Filament\Resources\MapelSiswaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMapelSiswas extends ListRecords
{
    protected static string $resource = MapelSiswaResource::class;

    protected static ?string $title = 'Daftar Mapel Siswa'; 

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
