<?php

namespace App\Models;

use App\Models\Website;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subscribers extends Model
{
    use Notifiable, HasFactory;

    protected $table = 'subscribers';

    protected $fillable = [
        'name',
        'email',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function websites()
    {
        return $this->belongsToMany(Website::class, 'website_subscribers', 'subscriber_id', 'website_id')
            ->withPivot('subscribed_at', 'ubsubscribed_at')
            ->as('subscription')
            ->withTimestamps();
    }

    public function subscribe(Website $website)
    {
        return $this->websites()->syncWithoutDetaching([
            $website->id        => [
                'subscribed_at' => now()
            ]
        ]);
    }
}
