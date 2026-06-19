<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function products()
    {
        return $this->hasMany(Product::class);
    }
    public function bioProfile()
    {
        return $this->hasOne(BioProfile::class,'user_id','id');
    }
    public function education()
    {
        
        return $this->hasMany(Education::class,'user_id','id');
    }

    public function categories()
    {
        return $this->hasMany(Category::class);
    }
    public function skill()
    {
        return $this->hasMany(Skill::class);
    }
    public function Userskill()
    {
        return $this->hasMany(UserSkill::class);
    }
    public function experience()
    {
        return $this->hasMany(ProfessionalExperience::class);
    }
    public function directorship()
    {
        return $this->hasMany(Directorship::class);
    }
    public function boardComiittee()
    {
        return $this->hasMany(BoardComitteeMember::class);
    }
    public function additionCertificate()
    {
        return $this->hasMany(AdditionalCertificate::class);
    }
    public function Publications()
    {
        return $this->hasMany(Publication::class);
    }
    public function award()
    {
        return $this->hasMany(Award::class);
    }

    public function forumSubscriptions()
    {
        return $this->hasMany(ForumSubscription::class);
    }

    public function subscribedForums()
    {
        return $this->belongsToMany(Forum::class, 'forum_subscriptions');
    }
}
