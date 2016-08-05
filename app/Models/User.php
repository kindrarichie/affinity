<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;

    protected $primaryKey = 'user_id';

    public $incrementing = false;

    protected $hidden = [
        'password',
    ];

    public function badges()
    {
        return $this->belongsToMany('App\Models\Badge', 'exploration.badges_awarded', 'members_id', 'badge_name')
                    ->select(['badges_id', 'name', 'url_image', 'url_web', 'award_date', 'published'])
                    ->orderBy('badges_id', 'ASC');
    }

    public function scopeEmail($q, $email)
    {
        if(app()->environment() == 'local')
        {
            return $q->whereEmail('nr_' . $email);
        }

        return $q->whereEmail($email);
    }
}
