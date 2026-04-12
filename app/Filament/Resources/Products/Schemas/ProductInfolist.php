<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ProductInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Section::make('Product Info')
                    ->schema([
                        TextEntry::make('name')
                            ->label('Product Name')
                            ->weight('bold')
                            ->color('primary'),

                        TextEntry::make('id')
                            ->label('Product ID'),

                        TextEntry::make('sku')
                            ->label('Product SKU')
                            ->badge()
                            ->color('warning'),

                        TextEntry::make('description')
                            ->label('Product Description')
                            ->columnSpanFull(),

                        TextEntry::make('created_at')
                            ->label('Product Creation Date')
                            ->date('d M Y')
                            ->color('info'),
                    ])
                    ->columnSpanFull(),

                Section::make('Product Price and Stock')
                    ->schema([
                        TextEntry::make('price')
                            ->label('Product Price')
                            ->weight('bold')
                            ->color('primary')
                            ->icon('heroicon-s-currency-dollar')
                            ->formatStateUsing(fn (string $state): string => 'Rp ' . number_format((float)$state, 0, ',', '.')),

                        TextEntry::make('stock')
                            ->icon('heroicon-o-cube')
                            ->label('Product Stock')
                            ->weight('bold')
                            ->color('primary'),
                    ])
                    ->columnSpanFull(),

                Section::make('Image and Status')
                    ->schema([
                        ImageEntry::make('image')
                            ->label('Product Image')
                            ->disk('public'),

                        IconEntry::make('is_active')
                            ->label('Is Active?')
                            ->boolean(),

                        IconEntry::make('is_featured')
                            ->label('Is Featured?')
                            ->boolean(),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}
