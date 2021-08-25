<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Method to define the relationship of User with TaskCategory
     * This returns the HasMany relationship i.e. User has many TaskCategory
     *
     * @return  Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function taskCategories()
    {
        return $this->hasMany(TaskCategory::class)->orderBy('id', 'asc');
    }

    /**
     * Method to define the relationship of User with Task
     * This returns the HasMany relationship i.e. User has many Task
     *
     * @return  Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function tasks()
    {
        return $this->hasMany(Task::class)->orderBy('id', 'asc');
    }
}
