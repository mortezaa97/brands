<?php

namespace Mortezaa97\Brands\Models;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Builder;

class Brand extends Model
{
    use HasFactory;
    use SoftDeletes;


    protected $guarded = [
        'id',
        'created_at',
        'updated_at'
    ];
    protected function casts(): array
    {
        return [
            'meta_keywords' => 'array',
            'color' => 'string',
        ];
    }
    protected $appends = [];
    protected $with = [];

    protected static function boot(){
        parent::boot();
        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderByDesc('created_at');
        });
    }



    /*
    * Relations
    */
    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function createdBy(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    public function updatedBy(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

}
