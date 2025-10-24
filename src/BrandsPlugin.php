<?php

declare(strict_types=1);

namespace Mortezaa97\Brands;

use Filament\Contracts\Plugin;
use Filament\Panel;

class BrandsPlugin implements Plugin
{
    public static function make(): static
    {
        return app(static::class);
    }

    public function getId(): string
    {
        return 'brands';
    }

    public function register(Panel $panel): void
    {
        $panel
            ->resources([
                //                'AddressResource' => AddressResource::class,
            ]);
    }

    public function boot(Panel $panel): void
    {
        //
    }
}
