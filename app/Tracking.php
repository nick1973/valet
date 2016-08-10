<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tracking extends Model
{
    protected $table = 'tracking';
    protected $fillable = [
        'ticket_number', 'ticket_price', 'ticket_name', 'ticket_registration', 'existing_customer', 'ticket_manufacturer',
        'ticket_model', 'ticket_colour', 'ticket_notes' ,'ticket_mobile' ,'ticket_key_safe', 'ticket_payment', 'ticket_status'
    ];
}