<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
   use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

   protected $table = 'crm_users';

   protected $fillable = [
       'company_id',
       'email_id', 
       'first_name',
       'last_name',
       'last_password_reset_date',
       'mobile_number',
       'user_name',
       'password',
       'user_profile_photo',
       'zone_id',
       'visibility_group_id', 
       'userset_id',
       'dob',
       'security_question',
       'security_answer',
       'is_deleted',
       'is_account_expired',
       'is_account_locked',
       'is_active',
       'is_credentials_expired',
       'created_by',
       'modified_by',
       'modified_at'
   ];

   protected $hidden = [
       'password',
       'remember_token',
   ];

   protected $casts = [
       'email_verified_at' => 'datetime',
       'password' => 'hashed',
       'is_deleted' => 'boolean',
       'is_account_expired' => 'boolean', 
       'is_account_locked' => 'boolean',
       'is_active' => 'boolean',
       'is_credentials_expired' => 'boolean'
   ];
}