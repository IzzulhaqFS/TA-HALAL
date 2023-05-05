<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\EventLog;
use Illuminate\Database\Eloquent\Concerns\HasUuids;


class SubActivity extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'sub_activities';
    protected $guarded = [];

    public function eventLog(){
        return $this->belongsTo(EventLog::class, 'event_log_id');
    }
}
