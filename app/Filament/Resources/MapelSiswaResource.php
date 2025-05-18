<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MapelSiswaResource\Pages;
use App\Filament\Resources\MapelSiswaResource\RelationManagers;
use App\Models\MapelSiswa;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Models\User;
use App\Models\Mapel;

class MapelSiswaResource extends Resource
{
    protected static ?string $model = MapelSiswa::class;

    protected static ?string $navigationGroup = 'Siswa';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Mata Pelajaran';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('mapel_id')
                    ->label('Mata Pelajaran')
                    ->required()
                    ->relationship('mapel', 'nama_mapel') 
                    ->searchable(),


                Forms\Components\Select::make('siswa_id')
                    ->label('Siswa')
                    ->required()
                    ->relationship('siswa', 'name') 
                    ->searchable()
                    ->options(function () {
                        return User::role('siswa')->pluck('name', 'id');
                    }),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('mapel.nama_mapel')
                    ->label('Mata Pelajaran')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('siswa.name')
                    ->label('Siswa')
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('siswa_id')
                    ->label('Siswa')
                    ->options(function () {
                        return User::role('siswa')->pluck('name', 'id');
                    })
                    ->query(function ($query) {
                        if (auth()->user()->hasRole('super_admin')) {
                            return $query;

                        }else if (auth()->user()->hasRole('Guru')) {
                            return $query->whereHas('mapel', function ($query) {
                                $query->where('guru_id', auth()->id()); 
                            });
                        }else {
                            return $query->where('siswa_id', auth()->id());
                        }
                    }), 
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListMapelSiswas::route('/'),
            'create' => Pages\CreateMapelSiswa::route('/create'),
            'edit' => Pages\EditMapelSiswa::route('/{record}/edit'),
        ];
    }
}
