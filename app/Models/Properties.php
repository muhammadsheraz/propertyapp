<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Properties extends Model
{
    //
    public $timestamps = false;

    public static function getAllBuy () {
        $records = DB::table('properties')->where('property_purpose', 'buy');

        if (auth()->user()->hasRole('administrator')) {
            return $records;
        } else {
            if (auth()->user()->hasRole('broker')) {
                return $records
                ->where('broker_id', auth()->user()->id)
                ->where('status', config('app.active'));
            } else if (auth()->user()->hasRole('customer')) {
                return $records
                ->where('customer_id', auth()->user()->id)
                ->where('status', config('app.active'))
                ->where('customer_status', config('app.active'));
            }
        }
    }
    
    public static function getAllRent () {
        $records = DB::table('properties')->where('property_purpose', 'rent');

        if (auth()->user()->hasRole('administrator')) {
            return $records;
        } else {
            if (auth()->user()->hasRole('broker')) {
                return $records
                ->where('broker_id', auth()->user()->id)
                ->where('status', config('app.active'));
            } else if (auth()->user()->hasRole('customer')) {
                return $records
                ->where('customer_id', auth()->user()->id)
                ->where('status', config('app.active'))
                ->where('customer_status', config('app.active'));
            }
        }
    }
    
    public static function getAllProperties () {
        $records = DB::table('properties')
            ->leftJoin('cities', 'properties.city_id', '=', 'cities.id')
            ->leftJoin('districts', 'properties.district_id', '=', 'districts.id')
            ->leftJoin('users', 'properties.broker_id', '=', 'users.id')
            ->select('properties.*', 'cities.city_name', 'districts.name AS district_name', 'users.first_name as broker_name');

        if (auth()->user()->hasRole('administrator')) {
            return $records;
        } else {
            if (auth()->user()->hasRole('broker')) {
                return $records
                ->where('properties.broker_id', auth()->user()->id)
                ->where('status', config('app.active'));
            } else if (auth()->user()->hasRole('customer')) {
                return $records
                ->where('properties.customer_id', auth()->user()->id)
                ->where('status', config('app.active'))
                ->where('customer_status', config('app.active'));
            }
        }
    }

    public static function getAllPropertiesForSelect () {
        $records = self::getAllProperties()->get();
        $select_data = [];

        if (!empty($records->count())) {
            foreach ($records as $record) {
                $select_data[$record->id] = $record->title;
            }
        }

        return $select_data;
    }

    public static function getTranslatedTitle () {
        
    }
}