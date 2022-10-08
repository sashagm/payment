<?php

namespace Sashagm\Payment\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
      'user_id',
      'sum',
      'sum_bonus',
      'provider',
      'status'
    ];    

    public function user()
    {
      return $this->belongsTo('App\Models\User');
    }
}
