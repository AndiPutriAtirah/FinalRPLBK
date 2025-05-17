<?php

namespace App\Filament\Resources\MapelResource\Pages;

use App\Filament\Resources\MapelResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMapel extends EditRecord
{
    protected static string $resource = MapelResource::class;

    protected static ?string $title = 'Edit Mata Pelajaran'; 

    protected function getRedirectUrl(): string
    {
        return route('filament.admin.resources.users.index');
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
