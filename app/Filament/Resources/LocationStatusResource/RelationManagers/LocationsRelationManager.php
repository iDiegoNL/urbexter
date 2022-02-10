<?php

namespace App\Filament\Resources\LocationStatusResource\RelationManagers;

use App\Models\LocationStatus;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\HasManyRelationManager;
use Filament\Resources\Table;
use Filament\Tables;

class LocationsRelationManager extends HasManyRelationManager
{
    protected static string $relationship = 'locations';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('location_status_id')
                    ->label('Status')
                    ->searchable()
                    ->required()
                    ->options(function () {
                        return LocationStatus::all()->pluck('name', 'id');
                    }),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
            ])
            ->filters([
                //
            ]);
    }
}
