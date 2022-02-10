<?php

namespace App\Filament\Resources;

use App\Actions\BladeIcons\GetAvailableIcons;
use App\Filament\Resources\LocationStatusResource\Pages;
use App\Filament\Resources\LocationStatusResource\RelationManagers;
use App\Models\LocationStatus;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class LocationStatusResource extends Resource
{
    protected static ?string $model = LocationStatus::class;

    protected static ?string $navigationIcon = 'heroicon-o-check-circle';

    public static function form(Form $form): Form
    {
        $iconicIcons = (new GetAvailableIcons())
            ->execute('vendor/itsmalikjones/blade-iconic/resources/svg', 'iconic');

        $heroIcons = (new GetAvailableIcons())
            ->execute('vendor/blade-ui-kit/blade-heroicons/resources/svg', 'heroicon');

        $icons = $iconicIcons
            ->merge($heroIcons)
            ->put('', 'No icon')
            ->toArray();

        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('color')
                    ->required()
                    ->searchable()
                    ->options([
                        'primary' => 'Primary',
                        'success' => 'Success',
                        'warning' => 'Warning',
                        'danger' => 'Danger',
                    ]),
                Forms\Components\Select::make('icon')
                    ->searchable()
                    ->options($icons),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('color'),
                Tables\Columns\TextColumn::make('icon'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime(),
            ])
            ->filters([
                //
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\LocationsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLocationStatuses::route('/'),
            'create' => Pages\CreateLocationStatus::route('/create'),
            'edit' => Pages\EditLocationStatus::route('/{record}/edit'),
        ];
    }
}
