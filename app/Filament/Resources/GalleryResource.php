<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GalleryResource\Pages;
use App\Filament\Resources\GalleryResource\RelationManagers;
use App\Models\Gallery;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Illuminate\Support\Facades\Auth;

class GalleryResource extends Resource
{
    protected static ?string $model = Gallery::class;
    protected static ?string $navigationGroup = 'Konten';

    protected static ?string $navigationIcon = 'heroicon-o-photo';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama_galeri')
                    ->required()
                    ->maxLength(255),

                TextInput::make('deskripsi')
                    ->maxLength(65535),

                Repeater::make('images')
                    ->relationship() // wajib agar bisa simpan ke tabel images secara otomatis
                    ->label('Daftar Gambar')
                    ->schema([
                       FileUpload::make('path')
    ->label('Gambar')
    ->directory('images')
    ->disk('public')
    ->required(),


                        TextInput::make('caption')
                            ->label('Keterangan')
                            ->maxLength(255)
                            ->nullable(),
                    ])
                    ->addActionLabel('Tambah Gambar')                     ->columns(2)
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('images.0.path')
                    ->label('Thumbnail')
                    ->height(150)
                    ->width(150),
                TextColumn::make('nama_galeri')->sortable()->searchable()->wrap(),
                TextColumn::make('deskripsi')->limit(50)->wrap(),

                Tables\Columns\TextColumn::make('created_at')->dateTime('d M Y'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                 ->requiresConfirmation()
            ])
            ->bulkActions([
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }
    public static function canViewAny(): bool
{
    return Auth::user()->role != 'pustakawan' ;
}
//         public static function shouldRegisterNavigation(): bool
// {
//     return Auth::user()->role !== 'pustakawan' ;
// }
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGalleries::route('/'),
            'create' => Pages\CreateGallery::route('/create'),
            'edit' => Pages\EditGallery::route('/{record}/edit'),
        ];
    }
}
