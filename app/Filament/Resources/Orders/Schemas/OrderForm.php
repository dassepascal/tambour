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
                    ->default(null),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required(),
                Select::make('status')
                    ->options(OrderStatus::class)
                    ->default('pending')
                    ->required(),
                TextInput::make('total')
                    ->required()
                    ->numeric()
                    ->prefix('€'),
                TextInput::make('stripe_session_id')
                    ->default(null),
            ]);
    }
}
