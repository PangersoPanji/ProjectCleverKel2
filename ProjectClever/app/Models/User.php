<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements FilamentUser
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'is_active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_active' => 'boolean',
    ];

    public function canAccessPanel(Panel $panel): bool
    {
        return match ($panel->getId()) {
            'admin' => $this->role === 'admin',
            'freelancer' => $this->role === 'freelancer',
            'public' => true,
            default => false,
        };
    }

    public function getFilamentAvatarUrl(): ?string
    {
        return null;
    }

    public function services(): HasMany
    {
        return $this->hasMany(Service::class);
    }

    public function clientProjects(): HasMany
    {
        return $this->hasMany(Project::class, 'client_id');
    }

    public function freelancerProjects(): HasMany
    {
        return $this->hasMany(Project::class, 'freelancer_id');
    }

}
