<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as ContractsAuditable;

class Contact extends Model implements ContractsAuditable
{
    use SoftDeletes;
    use Auditable;

    protected $primaryKey = 'contact_recordid';

    protected $auditEvents = [
        'updated',
        'deleted',
        'created',
    ];

    protected $fillable = [
        'contact_recordid', 'contact_name', 'contact_organizations', 'contact_services', 'contact_title', 'contact_department', 'contact_email', 'contact_phones', 'visibility', 'updated_by', 'created_by', 'locations', 'service_at_locations'
    ];

    public function organization()
    {
        return $this->belongsTo('App\Model\Organization', 'contact_organizations', 'organization_recordid');
        // return $this->belongsToMany('App\Model\Organization', 'organization_contacts', 'contact_recordid', 'organization_recordid');
    }

    public function organizations()
    {
        return $this->belongsToMany('App\Model\Organization', 'organization_contacts', 'contact_recordid', 'organization_recordid');
    }

    public function service()
    {

        $this->primaryKey = 'contact_recordid';

        return $this->belongsToMany('App\Model\Service', 'service_contacts', 'contact_recordid', 'service_recordid');
    }

    public function phone()
    {
        $this->primaryKey = 'contact_recordid';
        // return $this->belongsTo('App\Model\Phone', 'contact_phones', 'phone_recordid');
        return $this->belongsToMany('App\Model\Phone', 'contact_phones', 'contact_recordid', 'phone_recordid');
    }
}
