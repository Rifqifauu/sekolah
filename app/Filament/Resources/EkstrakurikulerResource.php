<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EkstrakurikulerResource\Pages;
use App\Models\Ekstrakurikuler;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class EkstrakurikulerResource extends Resource
{
    protected static ?string $model = Ekstrakurikuler::class;
    protected static ?string $navigationGroup = 'Konten';

    protected static ?string $navigationIcon = 'heroicon-m-academic-cap';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama')
                    ->label('Nama')
                    ->required()
                    ->maxLength(50),

                Textarea::make('deskripsi')    // gunakan Textarea untuk deskripsi
                    ->label('Deskripsi')
                    ->required()
                    ->rows(6),

                TextInput::make('nama_pembina')
                    ->label('Pembina')
                    ->required(),

                TextInput::make('nama_ketua')
                    ->label('Ketua')
                    ->required(),

                TextInput::make('jadwal')
                    ->label('Jadwal')
                    ->required()
                    ->maxLength(50),

                TextInput::make('lokasi')
                    ->label('Lokasi')
                    ->required()
                    ->maxLength(255),

                FileUpload::make('gambar')
                    ->label('Gambar')
                    ->image()               // validasi file harus gambar
                    ->directory('ekstrakurikuler')  // folder penyimpanan di storage/app/public/ekstrakurikuler
                    ->maxSize(1024)         // max 1MB, sesuaikan kebutuhan
                    ->required(false),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama')->label('Nama')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('deskripsi')->label('Deskripsi')->limit(20)->wrap(),
                Tables\Columns\TextColumn::make('nama_pembina')->label('Pembina')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('nama_ketua')->label('Ketua')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('jadwal')->label('Jadwal'),
                Tables\Columns\TextColumn::make('lokasi')->label('Lokasi'),
                Tables\Columns\ImageColumn::make('gambar')->label('Gambar')->disk('public')->rounded(),
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
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEkstrakurikulers::route('/'),
            'create' => Pages\CreateEkstrakurikuler::route('/create'),
            'edit' => Pages\EditEkstrakurikuler::route('/{record}/edit'),
        ];
    }
}
