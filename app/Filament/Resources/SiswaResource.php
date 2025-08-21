<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SiswaResource\Pages;
use App\Models\People;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Illuminate\Support\Facades\Auth;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SiswaResource extends Resource
{
    protected static ?string $model = People::class;

    protected static ?string $navigationIcon = 'heroicon-s-user-group';
    protected static ?string $navigationLabel = 'Data Siswa';
    protected static ?string $navigationGroup = 'People';
    protected static ?string $label = 'Siswa';
    protected static ?string $pluralLabel = 'Siswa';

    public static function form(Form $form): Form
    {
        return $form
           ->schema([
            Hidden::make('tipe')->default('siswa'),
            TextInput::make('nama')->label('Nama')->required(),
            TextInput::make('nomor_induk')->label('NIS')->required(),
            TextInput::make('detail')->label('Kelas'),
            TextInput::make('nomor_nfc')->label('No NFC'),
            DatePicker::make('tanggal_lahir')->label('Tanggal Lahir')->required(),
            Select::make('jenis_kelamin')->label('Jenis Kelamin')->required()->options([
                'L' => 'Laki-laki',
                'P' => 'Perempuan',
            ]),
            Textarea::make('alamat')->label('Alamat')->required(),
            TextInput::make('no_hp')->label('Nomor HP')->required(),
            FileUpload::make('foto')
                ->label('Foto')
                ->image()
                ->imageEditor()
                ->directory('foto-siswa')
                ->visibility('public')
                ->imagePreviewHeight('150'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn (Builder $query) => $query->where('tipe', 'siswa'))
            ->columns([
                TextColumn::make('nama')->label('Nama')->searchable(),
                TextColumn::make('nomor_induk')->label('NIS'),
                TextColumn::make('detail')->label('Kelas'),
                TextColumn::make('nomor_nfc')->label('No NFC'),
                TextColumn::make('jenis_kelamin')->label('Jenis Kelamin')->formatStateUsing(fn ($state) => $state === 'L' ? 'Laki-laki' : 'Perempuan'),
                TextColumn::make('tanggal_lahir')->label('Tanggal Lahir')->date(),
                TextColumn::make('no_hp')->label('Nomor HP'),
            ])
            ->filters([
                //
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
        return [];
    }
 public static function canViewAny(): bool
{
    return Auth::user()->role === 'super_admin' || Auth::user()->role === 'admin';
}
        public static function shouldRegisterNavigation(): bool
{
    return Auth::user()->role === 'super_admin' || Auth::user()->role === 'admin';
}
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSiswas::route('/'),
            'create' => Pages\CreateSiswa::route('/create'),
            'edit' => Pages\EditSiswa::route('/{record}/edit'),
        ];
    }


}
