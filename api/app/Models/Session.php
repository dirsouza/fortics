<?php

namespace App\Models;

use App\QueryFilters\Name;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pipeline\Pipeline;

class Session extends Model
{
    protected $table = 'sessions';
    protected $guarded = ['id'];
    public $timestamps = false;

    public function messages()
    {
        return $this->hasMany(Message::class, 'session_id', 'id');
    }

    public function scopeAllSessions(Builder $query): Builder
    {
        return app(Pipeline::class)
            ->send($query)
            ->through([
                Name::class,
            ])
            ->thenReturn();
    }

    public function scopeFindByIdentifier(Builder $query, string $identifier): Builder
    {
        return $query->whereContactIdentifier($identifier);
    }
}
