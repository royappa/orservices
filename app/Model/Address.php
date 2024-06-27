<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $primaryKey = 'address_recordid';

    protected $fillable = [
        'address_recordid', 'address_1', 'address_2', 'address_city', 'address_state_province', 'address_postal_code', 'address_region', 'address_country', 'address_attention', 'address_type', 'address_locations', 'address_services', 'address_organization', 'flag', 'is_main'
    ];

    public function getFullAddressAttribute()
    {
        $address = '';
        $address .= $this->address_1;
        $address .= ' ' . $this->address_2;
        $address .= ' ' . $this->address_city;
        $address .= ' ' . $this->address_state_province;
        $address .= ', ' . $this->address_postal_code;

        return $address;
    }

    public function getAddressTypeDataAttribute()
    {
        $typeString = [];
        if ($this->address_type) {
            $addressTypeIds = explode(',', $this->address_type);

            $addressTypes = AddressType::whereIn('id', $addressTypeIds)->get();
            foreach ($addressTypes as $key => $value) {
                $typeString[] = $value->type;
            }
        }

        return implode(', ', $typeString);
    }

    public function locations()
    {
        return $this->belongsToMany('App\Model\Location', 'location_addresses', 'address_recordid', 'location_recordid');
    }

    public function services()
    {
        return $this->belongsToMany('App\Model\Service', 'service_addresses', 'address_recordid', 'service_recordid');
    }

    static public function addressStateProvinces()
    {
        // Fetch distinct state/province names from the Address model
        $addressArray = self::select('address_state_province')
                            ->distinct()
                            ->whereNotNull('address_state_province')
                            ->orderBy('address_state_province', 'asc')
                            ->get();
        $result = [];
        foreach ($addressArray as $item) {
            $noSpaces = str_replace(['\r', '\n'], '_n_', $item->address_state_province);
            $result[] = ["id" => $item->address_state_province, "address_state_province" => $item->address_state_province];
        }

        // Re-index the result array to have consecutive numerical keys
        return array_values($result);
    }

    static public function addressRegions()
    {
        $addressArray = parent::get();
        $uniqueVals = [];
        $result = [];
        foreach($addressArray as $item) {
            $noSpaces = str_replace(' ', '', $item['address_region']);
            if(!in_array($noSpaces, $uniqueVals) && strlen($noSpaces) > 0) {
                $uniqueVals[] = $noSpaces;
                $result[] = ["id" => $noSpaces, "address_region" => $item['address_region']];
            }
        }
        return $result;
    }

    static public function addressRegionsOfaState($state) {
        //$addressArray = parent::where('address_state_province', $state)->get();
        //$addressArray = parent::whereRaw("REPLACE(address_state_province, ' ', '') = $state")->get();
        $addressArray = parent::whereRaw("REPLACE(address_state_province, ' ', '') = ?", [$state])->get();
        //print_r($addressArray);exit(1);
        $uniqueVals = [];
        $result = [];
        foreach($addressArray as $item) {
            $noSpaces = str_replace(' ', '', $item['address_region']);
            if(!in_array($noSpaces, $uniqueVals) && strlen($noSpaces) > 0) {
                $uniqueVals[] = $noSpaces;
                $result[] = ["id" => $noSpaces, "address_region" => $item['address_region']];
            }
        }
        return $result;
    }

    static public function addressCities()
    {
        $addressArray = self::select('address_city', 'address_state_province')
                            ->distinct()
                            ->whereNotNull('address_state_province')
                            ->whereNotNull('address_city')
                            ->orderBy('address_state_province', 'asc')
                            ->get();
        $result = [];

        foreach ($addressArray as $item) {
            $noSpaces = str_replace(['\r', '\n'], '_n_', $item->address_city);
            $result[] = ["address_city" => $noSpaces, "state" => $item->address_state_province];
        }

        // Re-index the result array to have consecutive numerical keys
        return array_values($result);
    }

    static public function addressCitiesOfaState($state) {
        $addressArray = self::select('address_city', 'address_state_province')
                            ->distinct()
                            ->whereNotNull('address_state_province')
                            ->whereNotNull('address_city')
                            ->where('address_state_province', 'like', "%{$state}%")
                            ->orderBy('address_city', 'asc')
                            ->get();
        $result = [];

        foreach ($addressArray as $item) {
            $noSpaces = str_replace(['\r', '\n'], '_n_', $item->address_city);
            $result[] = ["address_city" => $noSpaces, "state" => $item->address_state_province];
        }

        // Re-index the result array to have consecutive numerical keys
        return array_values($result);
    }    
}
