<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TugasResource\Pages;
use App\Filament\Resources\TugasResource\RelationManagers;
use App\Models\Tugas;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Models\User;


class TugasResource extends Resource
{
    protected static ?string $model = Tugas::class;

    protected static ?string $navigationLabel = 'Penugasan';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('materi_id')
                    ->label('Materi')
                    ->required()
                    ->relationship('materi', 'judul')
                    ->searchable(),

                Forms\Components\TextInput::make('judul')
                    ->label('Judul Tugas')
                    ->required()
                    ->maxLength(255),

                Forms\Components\DateTimePicker::make('deadline')
                    ->label('Deadline')
                    ->required(),

                Forms\Components\RichEditor::make('deskripsi')
                    ->label('Deskripsi Tugas')
                    ->columnSpanFull()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('materi.judul')
                    ->label('Materi')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('judul')
                    ->label('Judul Tugas')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('deadline')
                    ->label('Deadline')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
            ])
            ->filters([
                //
            Tables\Filters\SelectFilter::make('siswa_id')
                ->label('Siswa')
                ->options(function () {
                    return User::role('siswa')->pluck('name', 'id');
                })
                ->query(function ($query) {
                    $user = auth()->user();

                    if ($user->hasRole('super_admin')) {
                        return $query; 
                    }else if ($user->hasRole('Guru')) {
                        return $query->whereHas('materi.mapel', function ($q) use ($user) {
                            $q->where('guru_id', $user->id);
                        });
                    } else {
                        return $query->whereHas('materi.mapel.mapelSiswas', function ($q) use ($user) {
                            $q->where('siswa_id', $user->id);
                        });
                    }
                }), 
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTugas::route('/'),
            'create' => Pages\CreateTugas::route('/create'),
            'view' => Pages\ViewTugas::route('/{record}'),
            'edit' => Pages\EditTugas::route('/{record}/edit'),
        ];
    }
}
