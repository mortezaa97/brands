<?php

namespace Mortezaa97\Brands\Filament\Resources\Brands\Schemas;

use Filament\Schemas\Schema;
use Mortezaa97\Brands\Models\Brand;

class BrandForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            \Filament\Schemas\Components\Group::make()
                ->schema([
                    \Filament\Schemas\Components\Section::make()
                        ->schema([
                            \App\Filament\Components\Form\NameTextInput::create()->required(),
                            \App\Filament\Components\Form\SlugTextInput::create()->required(),
                            \App\Filament\Components\Form\LogoFileUpload::create(),
                            \App\Filament\Components\Form\StatusSelect::create(Brand::class)->required(),
                            \App\Filament\Components\Form\CategorySelect::create(),
                            \App\Filament\Components\Form\DescTextarea::create(),
                            \App\Filament\Components\Form\MetaTitleTextInput::create(),
                            \App\Filament\Components\Form\MetaDescTextarea::create(),
                            \App\Filament\Components\Form\MetaKeywordsTagsInput::create(),
                            \App\Filament\Components\Form\PageTitleTextInput::create(),
                            \Filament\Forms\Components\TextInput::make('color')->maxLength(255),
                            \App\Filament\Components\Form\CreatedBySelect::create()->required(),
                            \App\Filament\Components\Form\UpdatedBySelect::create(),

                        ])
                        ->columns(12)
                        ->columnSpan(12),
                ])
                ->columns(12)
                ->columnSpan(8),
            \Filament\Schemas\Components\Group::make()
                ->schema([
                    \Filament\Schemas\Components\Section::make()
                        ->schema([])
                        ->columns(12)
                        ->columnSpan(12),
                ])
                ->columns(12)
                ->columnSpan(4),
        ])
            ->columns(12);
    }
}
