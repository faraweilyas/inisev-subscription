<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Website extends Model
{
    use HasFactory;

    protected $table = 'websites';

    protected $fillable = [
        'user_id',
        'name',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    /**
     * Get creator
     *
     * @return HasRelationship
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get posts
     *
     * @return HasRelationship
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function subscribers()
    {
        return $this->belongsToMany(Subscribers::class, 'website_subscribers', 'website_id', 'subscriber_id')
            ->withPivot('subscribed_at', 'ubsubscribed_at')
            ->as('subscription')
            ->withTimestamps();
    }
}
