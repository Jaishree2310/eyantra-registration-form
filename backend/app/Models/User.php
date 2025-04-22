<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'contact_number',
        'gender',
        'year',
        'department_id',
        'college_id',
        'country_id',
        'email_verified_at',
        'is_registered'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_registered' => 'boolean',
        'year' => 'integer',
    ];

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function college(): BelongsTo
    {
        return $this->belongsTo(College::class);
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }
}