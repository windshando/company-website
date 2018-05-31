<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $type_id
 * @property int $content_id
 * @property string $date_added
 * @property string $date_modified
 * @property boolean $status
 */
class Page extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['type_id', 'created_at', 'updated_at', 'status'];

	public function contents() {
        return $this->belongsToMany('App\Models\Content');
    }

    public function type() {
        return $this->belongsTo('App\Models\Type');
    }

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

}
