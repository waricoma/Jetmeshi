<?php

declare(strict_types=1);

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag_map extends Model
{
  protected $fillable = ['post_id', 'tag_id'];
}
