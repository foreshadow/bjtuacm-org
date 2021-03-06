<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Ultraware\Roles\Traits\HasRoleAndPermission;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoleAndPermission;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function link()
    {
        return sprintf('<strong><a href="/user/%s">%s</a></strong>', $this->id, $this->name);
    }

    public function url()
    {
        return '/img/'.$this->avatar;
    }

    public function articles()
    {
        return $this->hasmany('App\Article');
    }

    public function publicArticles()
    {
        return $this->articles()->where('public', true);
    }

    public function online()
    {
        return $this->active_at && time() - strtotime($this->active_at) <= 5 * 60;
    }

    public function codeforces_user()
    {
        return $this->belongsTo('\App\CodeforcesUser', 'handle', 'handle');
    }

    public function level()
    {
        $level = 0;
        foreach ($this->getRoles() as $role) {
            $level = max($level, $role->level);
        }
        return $level;
    }

    public function assignableRoles($user_id = null)
    {
        $collection = $this->getRoles();
        if ($user_id) {
            $collection = $collection->diff(User::find($user_id)->getRoles());
        }
        $roles = [];
        foreach ($collection as $role) {
            if ($role->level < $this->level()) {
                $roles[$role->slug] = $role->name;
            }
        }
        return $roles;
    }
}
