<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{

    protected $fillable = [ 'chapter_type', 'chapter_description', 'can_have'];
}