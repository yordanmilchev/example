<?php

namespace App\Models;

use App\Models\ACL\Role;
use App\Models\Order\Order;
use App\Models\User\UserActivity;
use App\Models\User\UserAddress;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'lastname',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function address()
    {
        return $this->hasOne(UserAddress::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class); //returns relationship object
    }

    public function activity()
    {
        return $this->hasMany(UserActivity::class);
    }

    public function hasRole($role)
    {
        if (is_string($role)) {
            return $this->roles->contains('name', $role); //if user is assotiated with role with name '...'
        }

        //if argument is type collection
        foreach ($role as $r) {
            if ($this->hasRole($r->name)) { //recursion
                return true;
            }
        }

        return false;
    }

    public function getAddressAttributesFromOrders()
    {
        // structure of the address data that will be returned
        $addressAttributes = [
            'phone' => '',
            'city_name' => '',
            'municipality' => '',
            'district' => '',
            'country' => '',
            'address' => '',
            'created_at' => ''
        ];
        $lastOrderWithAddress = null;
        foreach ($this->orders->reverse() as $order) {
            if (!empty($order->delivery_city) && !empty($order->delivery_phone)) {
                $lastOrderWithAddress = $order;
                break;
            }
        }

        if ($lastOrderWithAddress) {
            $city = City::where('postal_code', $order->delivery_postal_code)->first();
            if ($city) {
                $addressAttributes['phone'] = $order->delivery_phone;
                $addressAttributes['city_name'] = $city->type . $city->name;
                $addressAttributes['municipality'] = $city->municipality;
                $addressAttributes['district'] = $city->district;
                $addressAttributes['country'] = $city->country;
                $addressAttributes['created_at'] = $order->created_at;
            }

            $addressParts = [];
            if ($order->delivery_postal_code) {
                $addressParts[] = 'Пощенски код: ' . $order->delivery_postal_code;
            }
            if ($order->delivery_street1) {
                $addressParts[] = 'Улица: ' . $order->delivery_street1;
            }
            if ($order->delivery_street2) {
                $addressParts[] = 'Улица 2: ' . $order->delivery_street2;
            }

            $addressAttributes['address'] = implode(', ', $addressParts);
        }

        return $addressAttributes;
    }
}
