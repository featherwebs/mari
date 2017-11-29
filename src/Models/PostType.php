<?php

namespace Featherwebs\Mari\Models;

use Illuminate\Database\Eloquent\Model;

class PostType extends Model
{
    protected $fillable = [ 'title', 'slug' ];
}
