<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PengumpulanTugasResource\Pages;
use App\Filament\Resources\PengumpulanTugasResource\RelationManagers;
use App\Models\PengumpulanTugas;
use App\Models\Tugas;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PengumpulanTugasResource extends Resource
{
    protected static ?string $model = PengumpulanTugas::class;

    protected static ?string $navigationLabel = 'Pengumpulan Tugas Siswa';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('tugas_id')
                    ->label('Tugas')
                    ->required()
                    ->relationship('tugas', 'judul')
                    ->searchable(),

                Forms\Components\Select::make('siswa_id')
                    ->label('Siswa')
                    ->required()
                    ->relationship('siswa', 'name')
                    ->default(auth()->id())
                    ->disabled(fn () => auth()->user()->hasRole('siswa'))
                    ->hidden(fn () => auth()->user()->hasRole('siswa')),

                Forms\Components\FileUpload::make('file_url')
                    ->label('Upload File Tugas')
                    ->disk('public')
                    ->columnSpanFull()
                    ->directory('pengumpulan_tugas'),
                
                Forms\Components\RichEditor::make('isi_tugas_editor')
                    ->label('Kerjakan Tugas dengan Editor')
                    ->columnSpanFull()
                    ->required(),

                Forms\Components\TextInput::make('nilai')
                    ->label('Nilai')
                    ->numeric()
                    ->minValue(0)
                    ->maxValue(100)
                    ->nullable()
                    ->visible(fn () => auth()->user()->hasAnyRole(['Guru', 'super_admin'])),

                Forms\Components\Textarea::make('komentar')
                    ->label('Komentar')
                    ->nullable()
                    ->visible(fn () => auth()->user()->hasAnyRole(['guru', 'super_admin'])),

                Forms\Components\Select::make('status')
                    ->label('Status')
                    ->options([
                        'submitted' => 'Submitted',
                        'dinilai' => 'Dinilai',
                    ])
                    ->default('submitted')
                    ->visible(fn () => auth()->user()->hasAnyRole(['guru', 'super_admin'])),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('tugas.judul')
                    ->label('Tugas')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('siswa.name')
                    ->label('Siswa')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('nilai')
                    ->label('Nilai')
                    ->formatStateUsing(fn($state) => floor($state) == $state ? (string) intval($state) : number_format($state, 2))
                    ->sortable(),

                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
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
                        } else if ($user->hasRole('Guru')) {  // perhatikan huruf kecil
                            return $query->whereHas('tugas.materi.mapel', function ($q) use ($user) {
                                $q->where('guru_id', $user->id);
                            });
                        } else if ($user->hasRole('Siswa')) {
                            return $query->whereHas('tugas.materi.mapel.mapelSiswas', function ($q) use ($user) {
                                $q->where('siswa_id', $user->id);
                            });
                        }
                        // fallback jika role lain
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
            'index' => Pages\ListPengumpulanTugas::route('/'),
            'create' => Pages\CreatePengumpulanTugas::route('/create'),
            'edit' => Pages\EditPengumpulanTugas::route('/{record}/edit'),
        ];
    }
}
