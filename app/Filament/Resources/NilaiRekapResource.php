<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NilaiRekapResource\Pages;
use App\Filament\Resources\NilaiRekapResource\RelationManagers;
use App\Models\NilaiRekap;
use Filament\Forms;
use Filament\Forms\Form;
use App\Models\Mapel; 
use Filament\Resources\Resource;
use Filament\Tables;
use App\Models\User;
use App\Models\MapelSiswa;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class NilaiRekapResource extends Resource
{
    protected static ?string $model = NilaiRekap::class;

    protected static ?string $navigationLabel = 'Rekap Nilai';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('siswa_id')
                    ->label('Siswa')
                    ->required()
                    ->relationship('siswa', 'name')
                    ->searchable(),

                Forms\Components\Select::make('mapel_id')
                    ->label('Mata Pelajaran')
                    ->required()
                    ->relationship('mapel', 'nama_mapel')
                    ->searchable(),

                Forms\Components\TextInput::make('nilai_akhir')
                    ->label('Nilai Akhir')
                    ->required()
                    ->numeric()
                    ->minValue(0)
                    ->maxValue(100),
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('siswa.name')
                    ->label('Siswa')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('mapel.nama_mapel')
                    ->label('Mata Pelajaran')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('nilai_akhir')
                    ->label('Nilai Akhir')
                    ->formatStateUsing(fn($state) => floor($state) == $state ? (string) intval($state) : number_format($state, 2))
                    ->sortable(),
                //
            ])
            ->filters([
    Tables\Filters\SelectFilter::make('siswa_id')
        ->label('Siswa')
        ->options(function () {
            return User::role('siswa')->pluck('name', 'id');
        })
        ->query(function ($query) {
            $user = auth()->user();

            if ($user->hasRole('super_admin')) {
                return $query; 
            } else if ($user->hasRole('Guru')) {

                return $query->whereHas('mapel', function ($q) use ($user) {
                    $q->where('guru_id', $user->id);
                });
            } else if ($user->hasRole('Siswa')) {

                return $query->where('siswa_id', $user->id);
            }

            return $query->whereRaw('0=1');
        }),
])

            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListNilaiRekaps::route('/'),
            'create' => Pages\CreateNilaiRekap::route('/create'),
            'edit' => Pages\EditNilaiRekap::route('/{record}/edit'),
        ];
    }
}
