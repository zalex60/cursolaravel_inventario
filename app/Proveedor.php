<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    protected $fillable = ['name', 'description', 'creator_id'];

    public function getNameLinkAttribute()
    {
        $title = __('app.show_detail_title', [
            'name' => $this->name, 'type' => __('proveedor.proveedor'),
        ]);
        $link = '<a href="'.route('proveedors.show', $this).'"';
        $link .= ' title="'.$title.'">';
        $link .= $this->name;
        $link .= '</a>';

        return $link;
    }

    public function creator()
    {
        return $this->belongsTo(User::class);
    }
}
