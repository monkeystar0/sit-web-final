<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservationItem extends Model
{
    use HasFactory;

    protected $table = 'reservation_items';

    protected $primaryKey = 'id';

    public $incrementing = true;
    protected $fillable = [
        'res_date', 'res_time' , 'cus_name', 'no_person', 'tel', 'email', 'note', 'no_item', 'status'
    ];

    public function menuItems()
    {
        return $this->hasMany(ReservationMenuItem::class, 'reservation_id');
    }
}
