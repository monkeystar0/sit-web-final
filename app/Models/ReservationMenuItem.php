<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservationMenuItem extends Model
{
    use HasFactory;


    protected $table = 'reservation_menu_items';
    protected $primaryKey = 'id';

    public $incrementing = true;
    protected $fillable = [
        'reservation_id', 'menu_id' , 'name', 'qty', 'price'
    ];

    public function reservation()
    {
        return $this->belongsTo(ReservationItem::class, 'reservation_id');
    }
    
}
