<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LocationResource\Pages;
use App\Filament\Resources\LocationResource\RelationManagers;
use App\Models\Location;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use League\ISO3166\ISO3166;

class LocationResource extends Resource
{
    protected static ?string $model = Location::class;

    protected static ?string $navigationIcon = 'heroicon-o-location-marker';

    public static function form(Form $form): Form
    {
        $maxYear = Carbon::now()->addYear()->year;

        $countries = collect((new ISO3166())->all())
            ->pluck('name', 'alpha2')->toArray();

        return $form
            ->schema([
                Forms\Components\Grid::make()
                    ->columns(1)
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\HasManyRepeater::make('aliases')
                            ->relationship('aliases')
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->required()
                                    ->maxLength(255),
                            ])
                            ->defaultItems(0)
                            ->createItemButtonLabel('Add alias'),
                        Forms\Components\MarkdownEditor::make('description')
                            ->required(),
                        Forms\Components\FileUpload::make('image_path')
                            ->required()
                            ->label('Image')
                            ->directory('locations'),
                        Forms\Components\Select::make('country')
                            ->required()
                            ->searchable()
                            ->options($countries)
                    ]),
                Forms\Components\TextInput::make('build_year')
                    ->numeric()
                    ->maxValue($maxYear),
                Forms\Components\TextInput::make('abandoned_year')
                    ->numeric()
                    ->maxValue($maxYear),
                Forms\Components\TextInput::make('demolished_year')
                    ->numeric()
                    ->maxValue($maxYear),
                Forms\Components\TextInput::make('reconverted_year')
                    ->numeric()
                    ->maxValue($maxYear),
            ]);
    }

    public static function table(Table $table): Table
    {
        $countries = collect((new ISO3166())->all())
            ->pluck('name', 'alpha2')->toArray();

        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                    ->limit(50)
                    ->searchable(),
                Tables\Columns\ImageColumn::make('image_path')
                    ->name('Image'),
                Tables\Columns\TextColumn::make('country'),
                Tables\Columns\TextColumn::make('build_year')
                    ->date('Y'),
                Tables\Columns\TextColumn::make('abandoned_year')
                    ->date('Y'),
                Tables\Columns\TextColumn::make('demolished_year')
                    ->date('Y'),
                Tables\Columns\TextColumn::make('reconverted_year')
                    ->date('Y'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime(),
            ])
            ->filters([
                Tables\Filters\MultiSelectFilter::make('country')
                    ->options($countries),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\AliasesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLocations::route('/'),
            'create' => Pages\CreateLocation::route('/create'),
            'edit' => Pages\EditLocation::route('/{record}/edit'),
        ];
    }
}
