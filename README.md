# Brands Package

[![Latest Version on Packagist](https://img.shields.io/packagist/v/mortezaa97/brands.svg?style=flat-square)](https://packagist.org/packages/mortezaa97/brands)
[![Total Downloads](https://img.shields.io/packagist/dt/mortezaa97/brands.svg?style=flat-square)](https://packagist.org/packages/mortezaa97/brands)

A Laravel package for managing product brands with full API support, authorization policies, and Filament integration.

## Features

- ✅ Complete CRUD operations for brands
- ✅ RESTful API endpoints with resource transformers
- ✅ Authorization policies for granular access control
- ✅ Soft deletes support
- ✅ Category relationships
- ✅ SEO-friendly with meta fields
- ✅ Slug-based routing
- ✅ User tracking (created by/updated by)
- ✅ Filament plugin ready
- ✅ API Resources for simple and detailed responses

## Installation

You can install the package via composer:

```bash
composer require mortezaa97/brands
```

### Service Provider Registration

The package will automatically register its service provider. If you need to manually register it, add the following to your `config/app.php`:

```php
'providers' => [
    // ...
    Mortezaa97\Brands\BrandsServiceProvider::class,
],
```

### Publish Assets

Publish the configuration file:

```bash
php artisan vendor:publish --provider="Mortezaa97\Brands\BrandsServiceProvider" --tag="config"
```

Publish migrations (optional, migrations are loaded automatically):

```bash
php artisan vendor:publish --provider="Mortezaa97\Brands\BrandsServiceProvider" --tag="migrations"
```

### Run Migrations

Run the migrations to create the brands table:

```bash
php artisan migrate
```

## Database Schema

The brands table includes the following fields:

| Field | Type | Description |
|-------|------|-------------|
| id | bigint | Primary key |
| name | string | Brand name |
| slug | string | URL-friendly identifier |
| logo | string (nullable) | Logo file path |
| status | smallint | Brand status (active/inactive) |
| category_id | foreignId (nullable) | Related category |
| desc | longText (nullable) | Brand description |
| meta_title | string (nullable) | SEO meta title |
| meta_desc | longText (nullable) | SEO meta description |
| meta_keywords | string (nullable) | SEO keywords |
| page_title | string (nullable) | Page display title |
| color | string (nullable) | Brand color theme |
| created_by | foreignId | User who created the brand |
| updated_by | foreignId (nullable) | User who last updated the brand |
| deleted_at | timestamp (nullable) | Soft delete timestamp |
| created_at | timestamp | Creation timestamp |
| updated_at | timestamp | Last update timestamp |

## Configuration

The configuration file `config/brands.php` allows you to customize:

```php
return [
    'table_name' => 'brands', // Customize table name if needed
];
```

## Usage

### API Endpoints

The package automatically registers the following API routes:

#### Get All Brands

```http
GET /api/brands
```

Returns a collection of brands with simple resource transformation.

**Response:**
```json
[
    {
        "name": "Nike",
        "slug": "nike",
        "logo": "https://example.com/storage/logos/nike.png",
        "color": "#000000"
    }
]
```

#### Get Single Brand

```http
GET /api/brands/{slug}
```

Returns a detailed brand resource including category relationship.

**Response:**
```json
{
    "name": "Nike",
    "slug": "nike",
    "logo": "https://example.com/storage/logos/nike.png",
    "desc": "Nike is a leading sportswear brand...",
    "meta_title": "Nike - Premium Sportswear",
    "meta_desc": "Discover Nike products...",
    "meta_keywords": "nike, sportswear, shoes",
    "page_title": "Nike Official Store",
    "color": "#000000",
    "category": {
        "id": 1,
        "name": "Sportswear",
        "slug": "sportswear"
    }
}
```

### Using in Your Code

#### Create a Brand

```php
use Mortezaa97\Brands\Models\Brand;

$brand = Brand::create([
    'name' => 'Adidas',
    'slug' => 'adidas',
    'logo' => 'path/to/logo.png',
    'status' => Status::ACTIVE,
    'category_id' => 1,
    'desc' => 'Premium sportswear brand',
    'meta_title' => 'Adidas Official',
    'color' => '#000000',
    'created_by' => auth()->id(),
]);
```

#### Query Brands

```php
// Get all active brands
$brands = Brand::all();

// Get brand by slug
$brand = Brand::where('slug', 'nike')->first();

// Get brands with category
$brands = Brand::with('category')->get();

// Get brands created by specific user
$brands = Brand::whereHas('createdBy', function($query) {
    $query->where('id', 1);
})->get();
```

#### Update a Brand

```php
$brand = Brand::find(1);
$brand->update([
    'name' => 'Updated Brand Name',
    'updated_by' => auth()->id(),
]);
```

#### Delete a Brand (Soft Delete)

```php
$brand = Brand::find(1);
$brand->delete(); // Soft delete

// Restore
$brand->restore();

// Force delete
$brand->forceDelete();
```

### Relationships

The Brand model includes the following relationships:

#### Category

```php
$brand = Brand::with('category')->first();
$categoryName = $brand->category->name;
```

#### Created By User

```php
$brand = Brand::with('createdBy')->first();
$creatorName = $brand->createdBy->name;
```

#### Updated By User

```php
$brand = Brand::with('updatedBy')->first();
if ($brand->updatedBy) {
    $updaterName = $brand->updatedBy->name;
}
```

### Authorization

The package includes a `BrandPolicy` for authorization. The following gates are available:

- `viewAny` - View list of brands
- `view` - View single brand
- `create` - Create new brand
- `update` - Update existing brand
- `delete` - Delete brand
- `restore` - Restore soft-deleted brand
- `forceDelete` - Permanently delete brand

Example usage in your controllers:

```php
use Illuminate\Support\Facades\Gate;

// Check if user can view brands
if (Gate::allows('viewAny', Brand::class)) {
    // User can view brands
}

// Authorize specific brand action
Gate::authorize('update', $brand);
```

### API Resources

The package provides two resource transformers:

#### BrandResource

Full details including relationships and SEO fields.

```php
use Mortezaa97\Brands\Http\Resources\BrandResource;

return new BrandResource($brand);
```

#### BrandSimpleResource

Simplified response for list views.

```php
use Mortezaa97\Brands\Http\Resources\BrandSimpleResource;

return BrandSimpleResource::collection($brands);
```

### Filament Integration

To integrate with Filament, register the plugin in your panel provider:

```php
use Mortezaa97\Brands\BrandsPlugin;

public function panel(Panel $panel): Panel
{
    return $panel
        ->plugins([
            BrandsPlugin::make(),
        ]);
}
```

## Facade

You can use the Brands facade for convenient access:

```php
use Mortezaa97\Brands\BrandsFacade as Brands;

// Use the facade
Brands::someMethod();
```

## Global Scope

The Brand model includes a global scope that orders all queries by `created_at` in descending order (newest first).

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email mortezajafari76@gmail.com instead of using the issue tracker.

## Credits

- [Morteza Jafari](https://github.com/mortezaa97)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

