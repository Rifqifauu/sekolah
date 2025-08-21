<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DataBukuResource\Pages;
use App\Models\DataBuku;
use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Resource;
use Filament\Facades\Filament;
use Illuminate\Support\Facades\Auth;

class DataBukuResource extends Resource
{
    protected static ?string $model = DataBuku::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';
    protected static ?string $navigationGroup = 'Perpustakaan';
    protected static ?string $navigationLabel = 'Data Buku';
    protected static ?string $modelLabel = 'Buku';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('judul_buku')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('pengarang')
                    ->required(),

                Forms\Components\TextInput::make('penerbit')
                    ->maxLength(255),

                Forms\Components\TextInput::make('tahun_terbit')
                    ->label('Tahun Terbit')
                    ->numeric()
                    ->minValue(1900)
                    ->maxValue(date('Y')),

                Forms\Components\TextInput::make('isbn')
                    ->maxLength(50),

                Forms\Components\FileUpload::make('cover')
                    ->directory('covers')
                    ->image()
                    ->imageEditor(),

                Forms\Components\TextInput::make('kategori')
                    ->maxLength(100),

                Forms\Components\TextInput::make('jumlah')
                    ->numeric()
                    ->minValue(0)
                    ->required(),

            ]);
    }

    public static function shouldRegisterNavigation(): bool
    {
        $plugin = Filament::getCurrentPanel()?->getPlugin('rmsramos/activitylog');

        return $plugin && Auth::check() && Auth::user()->role === 'pustakawan';
    }
    public static function canViewAny(): bool
{
    return Auth::user()->role === 'pustakawan';
}
    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('judul_buku'),
                Tables\Columns\TextColumn::make('tahun_terbit'),
                Tables\Columns\TextColumn::make('kategori'),
                Tables\Columns\TextColumn::make('jumlah')
                ->label('Total Stok'),
                Tables\Columns\TextColumn::make('jumlah_tersedia')
    ->label('Tersedia')
    ->state(fn (DataBuku $record) => max(0, ($record->jumlah ?? 0) - ($record->dipinjam ?? 0))),


                              Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'success' => 'tersedia',
                        'danger' => 'dipinjam',
                    ]),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'tersedia' => 'Tersedia',
                        'dipinjam' => 'Dipinjam',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListDataBukus::route('/'),
            'create' => Pages\CreateDataBuku::route('/create'),
            'edit' => Pages\EditDataBuku::route('/{record}/edit'),
        ];
    }
}
