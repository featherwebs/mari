<?php

namespace Featherwebs\Mari\Models;

use Featherwebs\Mari\Traits\Flushable;
use Illuminate\Database\Eloquent\Model;
use Venturecraft\Revisionable\RevisionableTrait;

class CustomField extends Model
{
    use RevisionableTrait, Flushable;
    protected $revisionCreationsEnabled = true;

    protected $guarded = [];

    public function customable()
    {
        return $this->morphTo();
    }
}
