<?php

namespace App\Models;

use App\Models\User;
use App\Models\Website;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';

    protected $fillable = [
        'website_id',
        'user_id',
        'slug',
        'title',
        'description',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function website()
    {
        return $this->belongsTo(Website::class);
    }

    public function website_subscribers()
    {
        return $this
            ->website
            ->subscribers();
    }

    public function active_website_subscribers()
    {
        return $this
            ->website_subscribers()
            ->where('subscribed_at', '!=', null)
            ->where('ubsubscribed_at', null);
    }

    public function website_unsubscribers()
    {
        return $this
            ->website_subscribers
            ->where('subscribed_at', '!=', null)
            ->where('ubsubscribed_at', '!=', null);
    }
}
