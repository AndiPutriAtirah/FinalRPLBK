<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MapelResource\Pages;
use App\Filament\Resources\MapelResource\RelationManagers;
use App\Models\Mapel;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MapelResource extends Resource
{
    protected static ?string $model = Mapel::class;
    
    // protected static ?string $navigationGroup = 'Dashboard Guru';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Mata Pelajaran';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                 Forms\Components\TextInput::make('nama_mapel')
                    ->label('Nama Mata Pelajaran')
                    ->required()
                    ->maxLength(255),

                // Pilih Guru
                Forms\Components\Select::make('guru_id')
                    ->label('Guru Pengajar')
                    ->required()
                    ->relationship('guru', 'name')
                    ->searchable()
                     ->options(function () {
                        // Pilih guru yang memiliki role 'guru'
                        return User::role('guru')->pluck('name', 'id');
                    }),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_mapel')
                    ->label('Nama Mata Pelajaran')  
                    ->sortable()                  
                    ->searchable(),             

                // Tables\Columns\TextColumn::make('guru.name')
                //     ->label('Guru Pengajar')    
                //     ->sortable()               
                //     ->searchable(),              
                ])
            ->filters([
                Tables\Filters\SelectFilter::make('guru_id')
                    ->label('Guru')
                    ->options(function () {
                        return User::role('Guru')->pluck('name', 'id');
                    })
                    ->query(function ($query) {
                        if (auth()->user()->hasRole('super_admin')) {
                            return $query;
                        }else {
                            return $query->where('guru_id', auth()->id());
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
            'index' => Pages\ListMapels::route('/'),
            'create' => Pages\CreateMapel::route('/create'),
            'edit' => Pages\EditMapel::route('/{record}/edit'),
        ];
    }
}
