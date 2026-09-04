<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('category_id')
                    ->relationship('category', 'name')
                    ->required(),
                TextInput::make('title')
                    ->required(),
                TextInput::make('slug')
                    ->required(),
                Textarea::make('description')
                    ->default(null)
                    ->columnSpanFull(),
                TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->prefix('€'),
                TextInput::make('diameter_cm')
                    ->numeric()
                    ->default(null),
                TextInput::make('skin_type')
                    ->default(null),
                TextInput::make('wood_type')
                    ->default(null),
                TextInput::make('weight_grams')
                    ->numeric()
                    ->default(null),
                TextInput::make('stock')
                    ->required()
                    ->numeric()
                    ->default(1),
                Toggle::make('is_custom_order')
                    ->required(),
                DateTimePicker::make('published_at'),
            ]);
    }
}
