<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    protected $fillable = [
        'comment', 'advertisement_id', 'parent_id', 'user_id',
    ];

/*    public function author() {
        return $this->belongsTo('App\User')->select('name');
    }

    public function parent()
    {
        return $this->belongsTo('App\Comments', 'parent_id');
    }

    public function children()
    {
        return $this->hasMany('App\Comments', 'parent_id');
    }

    public function countChildren($node = null)
    {
        $query = $this->children();
        if (!empty($node)) {
            $query = $query->where('node', $node);
        }

        $count = 0;
        foreach ($query->get() as $child) {
            // Plus 1 to count the direct child
            $count += $child->countChildren() + 1; 
        }
        return $count;
    }

    public function comments()
    {
        return $this->hasMany('App\Comments')->where('parent_id', null);
    }

    */

    public function advertisement() {
        return $this->belongsTo('App\Advertisement');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function parent()
    {
        return $this->belongsTo('App\Comments', 'parent_id');
    }

    public function hasReplay()
    {
        return $this->hasMany('App\Comments', 'parent_id');
    }

}
