<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MateriResource\Pages;
use App\Filament\Resources\MateriResource\RelationManagers;
use App\Models\Materi;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\RichEditor;
use App\Models\User;

class MateriResource extends Resource
{
    protected static ?string $model = Materi::class;

    protected static ?string $navigationLabel = 'Materi';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('mapel_id')
                    ->label('Mata Pelajaran')
                    ->required()
                    ->relationship('mapel', 'nama_mapel')
                    ->searchable(),

                Forms\Components\TextInput::make('judul')
                    ->label('Judul')
                    ->required(),
                
                // Forms\Components\FileUpload::make('media_url')
                //     ->label('URL Media (opsional)')
                //     ->nullable()
                //     ->columnSpanFull()
                //     ->image(),

                Forms\Components\RichEditor::make('deskripsi')
                    ->label('Deskripsi')
                    ->columnSpanFull()
                    ->required(),
                //
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
                Tables\Columns\TextColumn::make('judul')
                    ->label('Materi')
                    ->sortable()
                    ->searchable(),
                //
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
                            return $query->whereHas('mapel.mapelSiswas', function ($q) {
                                $q->where('siswa_id', auth()->id());
                            });
                        }
                    }), 
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListMateris::route('/'),
            'create' => Pages\CreateMateri::route('/create'),
            'view' => Pages\ViewMateri::route('/{record}'),
            'edit' => Pages\EditMateri::route('/{record}/edit'),
        ];
    }
}
