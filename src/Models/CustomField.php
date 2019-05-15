<?php

namespace Featherwebs\Mari\Models;

use Illuminate\Database\Eloquent\Model;
use Venturecraft\Revisionable\RevisionableTrait;

class CustomField extends Model
{
    use RevisionableTrait;
    protected $revisionCreationsEnabled = true;

    protected $guarded = [];

    public function customable()
    {
        return $this->morphTo();
    }
}
