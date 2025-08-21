<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StaffResource\Pages;
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
use Illuminate\Support\Facades\Auth;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class StaffResource extends Resource
{
    protected static ?string $model = People::class;

    protected static ?string $navigationIcon = 'heroicon-s-user-group';
    protected static ?string $navigationLabel = 'Data Staff';
    protected static ?string $label = 'Staff';
    protected static ?string $navigationGroup = 'People';
    protected static ?string $pluralLabel = 'Staff';

    public static function form(Form $form): Form
    {
        return $form
           ->schema([
            Hidden::make('tipe')->default('staff'),
            TextInput::make('nama')->label('Nama')->required(),
            TextInput::make('nomor_induk')->label('NIY')->required(),
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
                ->directory('foto-staff')
                ->visibility('public')
                ->imagePreviewHeight('150'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn (Builder $query) => $query->where('tipe', 'staf'))
            ->columns([
                TextColumn::make('nama')->label('Nama')->searchable(),
                TextColumn::make('nomor_induk')->label('NIY'),
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
            'index' => Pages\ListStaff::route('/'),
            'create' => Pages\CreateStaff::route('/create'),
            'edit' => Pages\EditStaff::route('/{record}/edit'),
        ];
    }


}
