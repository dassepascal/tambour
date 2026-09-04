<?php

namespace App\Filament\Resources\Orders\Schemas;

use App\Enums\OrderStatus;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class OrderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->label('Client')
                    ->default(null),
                TextInput::make('email')
                    ->label('Adresse email')
                    ->email()
                    ->required(),
                Select::make('status')
                    ->label('Statut')
                    ->options(OrderStatus::class)
                    ->default('pending')
                    ->required(),
                TextInput::make('total')
                    ->label('Total')
                    ->required()
                    ->numeric()
                    ->prefix('€'),
                TextInput::make('stripe_session_id')
                    ->label('Identifiant session Stripe')
                    ->default(null),
            ]);
    }
}
