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
                    ->label('Catégorie')
                    ->required(),
                TextInput::make('title')
                    ->label('Titre')
                    ->required(),
                TextInput::make('slug')
                    ->label('Slug')
                    ->required(),
                Textarea::make('description')
                    ->label('Description')
                    ->default(null)
                    ->columnSpanFull(),
                TextInput::make('price')
                    ->label('Prix')
                    ->required()
                    ->numeric()
                    ->prefix('€'),
                TextInput::make('diameter_cm')
                    ->label('Diamètre (cm)')
                    ->numeric()
                    ->default(null),
                TextInput::make('skin_type')
                    ->label('Type de peau')
                    ->default(null),
                TextInput::make('wood_type')
                    ->label('Type de bois')
                    ->default(null),
                TextInput::make('weight_grams')
                    ->label('Poids (g)')
                    ->numeric()
                    ->default(null),
                TextInput::make('stock')
                    ->label('Stock')
                    ->required()
                    ->numeric()
                    ->default(1),
                Toggle::make('is_custom_order')
                    ->label('Commande sur mesure')
                    ->required(),
                DateTimePicker::make('published_at')
                    ->label('Publié le'),
            ]);
    }
}
