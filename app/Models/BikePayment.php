<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BikePayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'bike_registration_id',
        'plan',
        'fixed_amount',
        'payment_method',
        'payment_slip',
        'last_paid_date',
        'next_due_date',
        'due_days',
        'due_amount',
        'total_paid',
        'status',
        'approval_status',
    ];

    protected $casts = [
        'last_paid_date' => 'date',
        'next_due_date'  => 'date',
    ];

    // 🔗 Relations
    public function bike()
    {
        return $this->belongsTo(BikeRegistration::class, 'bike_registration_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // 🔁 Auto Due Generator
    public function generateDue()
    {
        if (today()->greaterThan($this->next_due_date)) {

            $days = $this->plan == 'daily'
                ? today()->diffInDays($this->next_due_date)
                : today()->diffInWeeks($this->next_due_date);

            $this->due_days   += $days;
            $this->due_amount += ($days * $this->fixed_amount);

            $this->next_due_date = $this->plan == 'daily'
                ? $this->next_due_date->addDays($days)
                : $this->next_due_date->addWeeks($days);

            $this->save();
        }
    }

    // ✅ Admin Approve Payment
    public function approvePayment()
    {
        if ($this->approval_status !== 'pending') return false;

        $this->due_days   = max(0, $this->due_days - 1);
        $this->due_amount = max(0, $this->due_amount - $this->fixed_amount);

        $this->total_paid += $this->fixed_amount;
        $this->last_paid_date = now();

        $this->approval_status = 'approved';
        $this->save();

        return true;
    }

    // 🚫 Auto Block
    public function autoBlock()
    {
        if ($this->due_days >= 10) {
            $this->status = 'blocked';
            $this->save();
        }
    }
}
