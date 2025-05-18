<?php

namespace App\Filament\Resources\NilaiRekapResource\Pages;

use App\Filament\Resources\NilaiRekapResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListNilaiRekaps extends ListRecords
{
    protected static string $resource = NilaiRekapResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
