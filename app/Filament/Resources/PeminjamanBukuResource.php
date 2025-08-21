<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PeminjamanBukuResource\Pages;
use App\Models\Peminjaman;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Carbon;
use Filament\Facades\Filament;
use Illuminate\Support\Facades\Auth;

class PeminjamanBukuResource extends Resource
{
    protected static ?string $model = Peminjaman::class;
    protected static ?string $navigationGroup = 'Perpustakaan';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Forms untuk create/edit bisa ditambahkan kembali sesuai kebutuhan
            ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('anggota.nama')
                    ->label('Nama Anggota'),

                Tables\Columns\TextColumn::make('buku.judul_buku')
                    ->label('Judul Buku'),

                Tables\Columns\TextColumn::make('tanggal_pinjam')
                    ->label('Tanggal Pinjam')
                    ->date(),

                Tables\Columns\TextColumn::make('tanggal_kembali')
                    ->label('Tanggal Kembali')
                    ->date(),

                Tables\Columns\TextColumn::make('status')
                    ->label('Status'),

               Tables\Columns\TextColumn::make('is_late')
    ->label('Terlambat')
    ->getStateUsing(function ($record) {
        // hanya dihitung jika sudah dikembalikan dan tanggal_kembali tidak null
        if ($record->status !== 'dikembalikan' || !$record->tanggal_kembali) {
            return '-';
        }

        $batasKembali = Carbon::parse($record->tanggal_pinjam)->addDays(14);
        $tanggalKembali = Carbon::parse($record->tanggal_kembali);

        return $tanggalKembali->greaterThan($batasKembali) ? 'Ya' : 'Tidak';
    })
    ->badge()
    ->color(fn ($state) => $state === 'Ya' ? 'danger' : ($state === 'Tidak' ? 'success' : 'gray')),

Tables\Columns\TextColumn::make('terlambat_hari')
    ->label('Terlambat (hari)')
    ->getStateUsing(function ($record) {
        if ($record->status !== 'dikembalikan' || !$record->tanggal_kembali) {
            return '-';
        }

        $batasKembali = Carbon::parse($record->tanggal_pinjam)->addDays(14);
        $tanggalKembali = Carbon::parse($record->tanggal_kembali);

        if ($tanggalKembali->greaterThan($batasKembali)) {
            return $batasKembali->diffInDays($tanggalKembali) . ' hari';
        }

        return '0 hari';
    }),


            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Status Peminjaman')
                    ->options([
                        'dipinjam' => 'Dipinjam',
                        'dikembalikan' => 'Dikembalikan',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPeminjamanBukus::route('/'),
            'create' => Pages\CreatePeminjamanBuku::route('/create'),
            'edit' => Pages\EditPeminjamanBuku::route('/{record}/edit'),
        ];
    }
}
