<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\Select;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-m-user';
    protected static ?string $navigationGroup ='Manajemen User';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                ->label('Nama'),
                Forms\Components\TextInput::make('email')
                ->label('Email'),
                Forms\Components\TextInput::make('password')
                ->password()
                ->dehydrateStateUsing(fn ($state) => 
                    !empty($state) ? Hash::make($state) : null)
                ->dehydrated(fn ($state) => filled($state))
                ->required(fn (string $context): bool => $context === 'create'),
                Forms\Components\Select::make('role')
    ->label('Role')
    ->options([
        'user' => 'User',
        'admin' => 'Admin',
        'super_admin' => 'Super Admin',
    ]),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            Tables\Columns\TextColumn::make('name')
                ->searchable()
                ->sortable(),   
            Tables\Columns\TextColumn::make('email')
                ->searchable()
                ->sortable(), 
            Tables\Columns\TextColumn::make('role')
                ->badge()
                ->color(fn (string $state): string => match ($state) {
                    'admin' => 'success',
                    'super_admin' => 'warning',
                    'user' => 'info',
                })
                ->searchable()
                ->sortable(),
                
            Tables\Columns\TextColumn::make('created_at')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
                
            Tables\Columns\TextColumn::make('updated_at')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
        ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
    public static function getNavigationSort(): ?int
{
    return 12; 
}
    // public static function shouldRegisterNavigation(): bool
    // {
    //     // Pastikan hanya Super Admin yang dapat mengakses resource ini
    //     return Auth::user() && Auth::user()->role === 'super_admin';
    // }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
        ];
    }
}
