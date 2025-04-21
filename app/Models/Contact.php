<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
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
        'subject',
        'message',
        'status'
    ];

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
            'new' => 'success',
            'read' => 'info',
            'replied' => 'primary',
            'archived' => 'secondary'
        ];

        $color = $statusMap[$this->status] ?? 'secondary';

        return '<span class="badge bg-' . $color . '">' . ucfirst($this->status) . '</span>';
    }
}
