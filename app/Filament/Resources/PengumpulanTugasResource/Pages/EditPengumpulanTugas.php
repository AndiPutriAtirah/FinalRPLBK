<?php

namespace App\Filament\Resources\PengumpulanTugasResource\Pages;

use App\Filament\Resources\PengumpulanTugasResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPengumpulanTugas extends EditRecord
{
    protected static string $resource = PengumpulanTugasResource::class;

    protected static ?string $title = 'Edit Tugas'; 

    protected function getRedirectUrl(): string
    {
        return route('filament.admin.resources.pengumpulan-tugas.index');
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
