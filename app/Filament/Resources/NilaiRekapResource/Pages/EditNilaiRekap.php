<?php

namespace App\Filament\Resources\NilaiRekapResource\Pages;

use App\Filament\Resources\NilaiRekapResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditNilaiRekap extends EditRecord
{
    protected static string $resource = NilaiRekapResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
