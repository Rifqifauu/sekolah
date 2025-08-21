<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PPDBResource\Pages;
use App\Models\Pendaftaran;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Storage;
use Filament\Tables\Actions\Action;
use Illuminate\Support\Facades\Auth;

class PPDBResource extends Resource
{
    protected static ?string $model = Pendaftaran::class;


    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Pendaftaran SPMB';
    protected static ?string $navigationGroup = 'Website';
    protected static ?string $pluralModelLabel = 'Pendaftaran';

    // ✅ SCHEMA DITAMPILKAN DI HALAMAN VIEW JUGA
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Data Siswa')->columns(2)->schema([
                    Forms\Components\TextInput::make('nama')->disabled(),
                    Forms\Components\TextInput::make('nisn')->disabled(),
                    Forms\Components\TextInput::make('tempat_tanggal_lahir')->label('Tempat & Tanggal Lahir')->disabled(),
                    Forms\Components\TextInput::make('jenis_kelamin')->disabled(),
                    Forms\Components\TextInput::make('agama')->disabled(),
                ]),

                Forms\Components\Section::make('Asal & Program')->columns(2)->schema([
                    Forms\Components\TextInput::make('asal_sekolah')->label('Asal Sekolah')->disabled(),
                    Forms\Components\TextInput::make('pilihan_program')->label('Pilihan Program')->disabled(),
                ]),

                Forms\Components\Section::make('Alamat')->columns(3)->schema([
                    Forms\Components\Textarea::make('alamat')->disabled()->columnSpanFull(),
                    Forms\Components\TextInput::make('desa')->disabled(),
                    Forms\Components\TextInput::make('kecamatan')->disabled(),
                    Forms\Components\TextInput::make('kabupaten')->disabled(),
                    Forms\Components\TextInput::make('provinsi')->disabled(),
                    Forms\Components\TextInput::make('rt')->disabled(),
                    Forms\Components\TextInput::make('rw')->disabled(),
                    Forms\Components\TextInput::make('kode_pos')->disabled(),
                ]),

                Forms\Components\Section::make('Orang Tua')->columns(3)->schema([
                    Forms\Components\TextInput::make('nama_ayah')->disabled(),
                    Forms\Components\TextInput::make('pekerjaan_ayah')->disabled(),
                    Forms\Components\TextInput::make('penghasilan_ayah')->disabled(),
                    Forms\Components\TextInput::make('nama_ibu')->disabled(),
                    Forms\Components\TextInput::make('pekerjaan_ibu')->disabled(),
                    Forms\Components\TextInput::make('penghasilan_ibu')->disabled(),
                    Forms\Components\TextInput::make('nama_wali')->disabled(),
                    Forms\Components\TextInput::make('pekerjaan_wali')->disabled(),
                    Forms\Components\TextInput::make('penghasilan_wali')->disabled(),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('nisn')->sortable(),
                Tables\Columns\TextColumn::make('asal_sekolah')->label('Asal Sekolah')->sortable(),
                Tables\Columns\TextColumn::make('pilihan_program')->label('Pilihan Program'),
            ])
            ->actions([
               Action::make('download_formulir')
    ->label('Formulir')
    ->icon('heroicon-o-arrow-down-tray')
    ->url(fn (Pendaftaran $record) => route('pendaftaran.pdf', $record->id))
    ->openUrlInNewTab(),

Action::make('download_dokumen')
    ->label('Dokumen')
    ->icon('heroicon-o-document')
    ->url(fn (Pendaftaran $record) => Storage::url($record->dokumen_path))
    ->openUrlInNewTab()
    ->visible(fn (Pendaftaran $record) => filled($record->dokumen_path)),

Action::make('view_foto')
    ->label('Foto')
    ->icon('heroicon-o-photo')
    ->url(fn (Pendaftaran $record) => Storage::url($record->foto_path))
    ->openUrlInNewTab()
    ->visible(fn (Pendaftaran $record) => filled($record->foto_path)),


              Tables\Actions\DeleteAction::make()
    ->requiresConfirmation(),

                Tables\Actions\ViewAction::make(), // ✅ ini otomatis pakai schema dari form()
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getSlug(): string
    {
        return 'spmb';
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
            'index' => Pages\ListPPDBS::route('/'),
            'view' => Pages\ViewPPDB::route('/{record}'),
        ];
    }
}
