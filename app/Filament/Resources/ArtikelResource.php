<?php
namespace App\Filament\Resources;

use App\Filament\Resources\ArtikelResource\Pages;
use App\Models\Artikel;
use Filament\Forms;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Form; 
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Forms\Components\RichEditor;
use AmidEsfahani\FilamentTinyEditor\TinyEditor;




class ArtikelResource extends Resource
{
    protected static ?string $model = Artikel::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationGroup = 'Konten';
    protected static ?string $navigationLabel = 'Artikel';

    public static function form(Form $form): Form
{
    return $form->schema([
        Forms\Components\TextInput::make('judul')
            ->required()
            ->debounce(500),  // kasih delay supaya gak terlalu sering trigger

        Forms\Components\TextInput::make('slug')
            ->required()
            ->unique(ignoreRecord: true)
            ->suffixAction(
                Action::make('generateSlug')
                    ->label('Auto')
                      ->icon('heroicon-m-sparkles') 
                    ->action(function ($state, callable $set, callable $get) {
                        $set('slug', Str::slug($get('judul') ?? ''));
                    })
            ),

        Forms\Components\FileUpload::make('gambar')
            ->image()
            ->directory('artikel')
            ->nullable(),

 RichEditor::make('isi')
    ->fileAttachmentsDisk('public')            // untuk penyimpanan file
    ->fileAttachmentsVisibility('public')      // agar file bisa diakses publik
    ->fileAttachmentsDirectory('uploads')      // folder upload file
    ->columnSpan('full')                        // full width
    ->required()
    ->direction('ltr')                         // bisa juga 'auto' atau 'rtl'
    ->resize('both'),  

        Forms\Components\Select::make('kategori')
            ->options([
                'Berita' => 'Berita',
                'Prestasi' => 'Prestasi',
                'Umum' => 'Umum',
            ])
            ->required(),

        Forms\Components\Select::make('id_user')
            ->relationship('user', 'name')
            ->label('Penulis')
            ->searchable()
            ->preload()
            ->required(),

        Forms\Components\Select::make('status')
            ->options([
                'draft' => 'Draft',
                'published' => 'Published',
            ])
            ->default('draft')
            ->required(),

        Forms\Components\DateTimePicker::make('published_at')
            ->label('Tanggal Terbit')
            ->nullable(),
    ]);
}

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('judul')->searchable()->sortable()->wrap(),
                Tables\Columns\TextColumn::make('kategori'),
                Tables\Columns\TextColumn::make('user.name')->label('Penulis'),
                Tables\Columns\TextColumn::make('view_count')->label('Dilihat'),
                Tables\Columns\TextColumn::make('status')->badge(),
                Tables\Columns\TextColumn::make('published_at')->label('Terbit')->dateTime(),
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListArtikels::route('/'),
            'create' => Pages\CreateArtikel::route('/create'),
            'edit' => Pages\EditArtikel::route('/{record}/edit'),
        ];
    }
}
