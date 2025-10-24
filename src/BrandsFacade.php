<?php

namespace Mortezaa97\Brands;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Mortezaa97\Brands\Skeleton\SkeletonClass
 */
class BrandsFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'brands';
    }
}
