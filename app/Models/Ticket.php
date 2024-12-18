<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    const STATUS_OPENED = 'Opened';
    const STATUS_IN_PROGRESS = 'In Progress';
    const STATUS_ON_HOLD = 'On Hold';
    const STATUS_CLOSED = 'Closed';

    public static function getStatusOptions()
    {
        return [
            self::STATUS_OPENED,
            self::STATUS_IN_PROGRESS,
            self::STATUS_ON_HOLD,
            self::STATUS_CLOSED,
        ];
    }
    
    protected $fillable = [
        'title',
        'description',
        'status',
        'user_id',
        'agent_id',
    ];

    protected function casts(): array
    {
        return ['closed_at'=>'datetime:d M Y h:i'];
    }

    public function user()  
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Define the relationship to the agent (optional, who resolves the ticket)
    public function agent()
    {
        return $this->belongsTo(User::class, 'agent_id');
    }
}
