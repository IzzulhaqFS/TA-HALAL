<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\EventLog;

class SubActivity extends Model
{
    use HasFactory;
    protected $table = 'sub_activities';
    protected $guarded = ['id'];

    public function eventLog(){
        return $this->belongsTo(EventLog::class, 'event_log_id');
    }
}
