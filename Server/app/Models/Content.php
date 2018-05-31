<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $lang_id
 * @property string $title
 * @property string $decription
 * @property string $meta_tag_title
 * @property string $meta_tag_decription
 * @property string $meta_tag_keywords
 */
class Content extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['lang_id', 'title', 'decription', 'meta_tag_title', 'meta_tag_decription', 'meta_tag_keywords'];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

}
