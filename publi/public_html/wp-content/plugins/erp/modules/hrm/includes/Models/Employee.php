<?php

namespace WeDevs\ERP\HRM\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use WeDevs\ERP\Framework\Model;

/**
 * Class Employee
 */
class Employee extends Model {
    use SoftDeletes;

    protected $table = 'erp_hr_employees';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'employee_id',
        'designation',
        'department',
        'location',
        'hiring_source',
        'hiring_date',
        'termination_date',
        'date_of_birth',
        'reporting_to',
        'pay_rate',
        'pay_type',
        'type',
        'status',
        'delete_at',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [ 'deleted_at', 'date_of_birth' ];

    /**
     * Relation to Leave_request model
     *
     * @since 1.2.0
     *
     * @return object
     */
    public function leave_requests() {
        return $this->hasMany( 'WeDevs\ERP\HRM\Models\LeaveRequest', 'user_id', 'user_id' );
    }

    public function scopeleave_requests() {
        return $this->hasMany( 'WeDevs\ERP\HRM\Models\LeaveRequest', 'user_id', 'user_id' );
    }

    public function educations() {
        return $this->hasMany( 'WeDevs\ERP\HRM\Models\Education', 'employee_id', 'user_id' );
    }

    public function dependents() {
        return $this->hasMany( 'WeDevs\ERP\HRM\Models\Dependents', 'employee_id', 'user_id' );
    }

    public function experiences() {
        return $this->hasMany( 'WeDevs\ERP\HRM\Models\WorkExperience', 'employee_id', 'user_id' );
    }

    public function histories() {
        return $this->hasMany( 'WeDevs\ERP\HRM\Models\EmployeeHistory', 'user_id', 'user_id' );
    }

    public function performances() {
        return $this->hasMany( '\WeDevs\ERP\HRM\Models\Performance', 'employee_id', 'user_id' );
    }

    public function announcements() {
        return $this->hasMany( '\WeDevs\ERP\HRM\Models\Announcement', 'user_id', 'user_id' );
    }

    public function entitlements() {
        return $this->hasMany( '\WeDevs\ERP\HRM\Models\LeaveEntitlement', 'user_id', 'user_id' )->where( 'trn_type', '=', 'leave_policies' );
    }

    public function notes() {
        return $this->hasMany( 'WeDevs\ERP\HRM\Models\Employee_Note', 'user_id', 'user_id' );
    }

    public function user() {
        return $this->belongsTo( 'WeDevs\ERP\HRM\Models\HrUser', 'user_id', 'ID' );
    }
}
