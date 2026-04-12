<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
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

                Tabs::make('Product Tabs')
                    ->vertical()
                    ->tabs([

                        // --- 1. Tab Product Info ---
                        Tab::make('Product Details')
                        ->icon('heroicon-o-information-circle')
                        ->schema([
                            TextEntry::make('name')
                                ->label('Product Name')
                                ->weight('bold')
                                ->color('primary'),
                            TextEntry::make('sku')
                                ->label('Product SKU')
                                ->badge()
                                ->color('success'),
                            TextEntry::make('description')
                                ->label('Product Description'),
                            TextEntry::make('created_at')
                                ->label('Product Creation Date')
                                ->date('d M Y')
                                ->color('info'),
                        ])->columnSpanFull(),

                        // --- 2. Tab Pricing & Stock ---
                        Tab::make('Pricing & Stock')
                        ->icon('heroicon-o-banknotes') 
                        ->badge(fn ($record) => $record->stock) 
                        ->badgeColor(fn ($record) => $record->stock < 10 ? 'danger' : 'success') 
                        ->schema([
                            TextEntry::make('price')
                                ->label('Product Price')
                                ->weight('bold')
                                ->color('primary')
                                ->icon('heroicon-s-currency-dollar')
                                ->formatStateUsing(fn (string $state): string => 'Rp ' . number_format((float)$state, 0, ',', '.')),
                            TextEntry::make('stock')
                                ->label('Product Stock')
                                ->weight('bold')
                                ->color('primary')
                                ->icon('heroicon-o-cube'),
                        ])->columnSpanFull(),

                        // --- 3. Tab Media & Status ---
                        Tab::make('Media & Status')
                            ->icon('heroicon-o-photo')
                            ->schema([
                                ImageEntry::make('image')
                                    ->label('Product Image')
                                    ->disk('public'),
                                IconEntry::make('is_active')
                                    ->label('Active')
                                    ->boolean(),
                                IconEntry::make('is_featured')
                                    ->label('Featured')
                                    ->boolean(),
                            ]),

                    ])
                    ->columnSpanFull(),
            ]);
    }
}
