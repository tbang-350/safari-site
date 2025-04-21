<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'tour',
        'date',
        'message',
        'status'
    ];

    /**
     * Get the formatted date.
     *
     * @return string
     */
    public function getFormattedDateAttribute()
    {
        return \Carbon\Carbon::parse($this->date)->format('F j, Y');
    }

    /**
     * Get the formatted created date.
     *
     * @return string
     */
    public function getFormattedCreatedAtAttribute()
    {
        return $this->created_at->format('F j, Y, g:i a');
    }

    /**
     * Get the status badge HTML.
     *
     * @return string
     */
    public function getStatusBadgeAttribute()
    {
        $statusMap = [
            'pending' => 'warning',
            'confirmed' => 'success',
            'cancelled' => 'danger',
            'completed' => 'info'
        ];

        $color = $statusMap[$this->status] ?? 'secondary';

        return '<span class="badge bg-' . $color . '">' . ucfirst($this->status) . '</span>';
    }
}
