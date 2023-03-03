<?php

namespace App\Models;

use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contact extends Model
{
    use HasFactory;
    public $fillable = ['email', 'subject', 'details'];

    /**
     * Write code on Method
     *
     * @return response()
     */
    public static function boot()
    {
        parent::boot();

        static::created(function ($item) {

            $adminEmail = config('mail.from.address');
            Mail::to($adminEmail)->queue(new ContactMail($item));
        });
    }
}
