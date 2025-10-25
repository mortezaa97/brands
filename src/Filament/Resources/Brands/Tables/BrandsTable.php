<?php

namespace Mortezaa97\Brands\Filament\Resources\Brands\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Mortezaa97\Brands\Models\Brand;

class BrandsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                \App\Filament\Components\Table\LogoImageColumn::create(),
                \App\Filament\Components\Table\NameTextColumn::create(),
                \App\Filament\Components\Table\SlugTextColumn::create(),
                \App\Filament\Components\Table\StatusTextColumn::create(Brand::class),
                \App\Filament\Components\Table\MetaTitleTextColumn::create(),
                \App\Filament\Components\Table\MetaKeywordsTextColumn::create(),
                \App\Filament\Components\Table\PageTitleTextColumn::create(),
                \App\Filament\Components\Table\CreatedByTextColumn::create(),
                \App\Filament\Components\Table\UpdatedByTextColumn::create(),
                \App\Filament\Components\Table\DeletedAtTextColumn::create(),
                \App\Filament\Components\Table\CreatedAtTextColumn::create(),
                \App\Filament\Components\Table\UpdatedAtTextColumn::create(),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }
}
