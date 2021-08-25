<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    /**
     * Method to define the relationship of Task with User
     * This returns the BelongsTo relationship i.e. Task belongs to User
     *
     * @return  Illuminate\Database\Eloquent\Relations\BelongsTo
     *
     */
    public function user()
    {
        return $this->belogsTo('App\Models\User');
    }
}
