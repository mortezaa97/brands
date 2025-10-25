<?php

declare(strict_types=1);

namespace Mortezaa97\Brands\Traits;

use Mortezaa97\Brands\Models\Brand;

trait HasBrand
{
    /**
     * Get brand for this model.
     */
    public function brand(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }
}
