<?php

namespace App\Libraries\Sharable;

use App\User;
use App\Models\V1\Groups\Group;
use App\Models\V1\Contacts\Contact;
use App\Http\Controllers\Admin\Backpacks\Permissions\Model\NewRole;

trait SharableModelTrait
{
    // protected $sharableTable = 'property_shares'; // define this in main model
    protected $sharableKey = 'sharable_id';
    protected $sharableType = 'sharable_type';
    protected $sharableAccessLevel = 'access_level';

    public $userNameSpace = 'App\User';
    public $newRoleNameSpace = 'App\Http\Controllers\Admin\Backpacks\Permissions\Model\NewRole';
    public $groupNameSpace = 'App\Models\V1\Groups\Group';

    // protected $touches = ['shareToNewRole', 'shareToContact', 'shareToGroup']; // update parent timestamp

    public function getAllNewRolesAttribute()
    {
        return NewRole::all();
    }

    public function getAllUsersAttribute()
    {
        return User::all();
    }

    public function getAllGroupsAttribute()
    {
        return Group::all();
    }

    // RELATIONSHIP
    public function shareToNewRole()
    {
        return $this->shareRelationTo(NewRole::class, config('const.options.sharable.new_role'));
    }

    public function shareToContact()
    {
        return $this->shareRelationTo(Contact::class, config('const.options.sharable.contact'));
    }

    public function shareToUser()
    {
        return $this->shareRelationTo(User::class, config('const.options.sharable.user'));
    }

    public function shareToGroup()
    {
        return $this->shareRelationTo(Group::class, config('const.options.sharable.group'));
    }

    protected function shareRelationTo($namespace, $shareType)
    {
        return $this->belongsToMany($namespace, $this->sharableTable, 'row_id', $this->sharableKey)
        ->wherePivot($this->sharableType, $shareType)
        ->withPivot('id', 'access_level', 'sharable_type')
        ->withTimestamps();
    }

    // SCOPE
    public function scopeIsSharableUpdate($query, $type = false)
    {
        $allowAccessLevel = [
            config('const.options.sharable.access_levels.update'),
            config('const.options.sharable.access_levels.all')
        ];

        return $this->shareQueryByAccessLevel($query, $allowAccessLevel, $type);
    }

    public function scopeIsSharableDelete($query, $type = false)
    {
        $allowAccessLevel = [
            config('const.options.sharable.access_levels.delete'),
            config('const.options.sharable.access_levels.all')
        ];

        return $this->shareQueryByAccessLevel($query, $allowAccessLevel, $type);
    }

    public function scopeIsSharableAll($query, $type = false)
    {
        $allowAccessLevel = [
            config('const.options.sharable.access_levels.all')
        ];

        return $this->shareQueryByAccessLevel($query, $allowAccessLevel, $type);
    }

    public function scopeIsSharableRead($query, $type = false)
    {
        $allowAccessLevel = [
            config('const.options.sharable.access_levels.view'),
            config('const.options.sharable.access_levels.all'),
        ];

        return $this->shareQueryByAccessLevel($query, $allowAccessLevel, $type);
    }

    // FUNCTION
    public function shareQueryByAccessLevel($query, $allowAccessLevel, $type = false)
    {
        $user = optional(backpack_user());

        if ($user->isTopNewRole()) {
            // when Role is Central == depth 1 it can see everything
            // Or any special condition for top Level

        } else {
            // if not Central == depth 1 see base on sharable property
            if ($user) {
                // New Role condition
                $query->whereHas('shareToNewRole', function ($q) use ($user, $allowAccessLevel) {
                    $q->whereIn($this->sharableKey, [$user->new_role_id]);
                    $this->shareQueryByREGEXP($q, $this->sharableAccessLevel, $allowAccessLevel);
                });

                // User condition
                $query->orWhereHas('shareToUser', function ($q) use ($user, $allowAccessLevel) {
                    $q->whereIn($this->sharableKey, [$user->id]);
                    $this->shareQueryByREGEXP($q, $this->sharableAccessLevel, $allowAccessLevel);
                });

                // // Contact condition
                // $contact = optional($user->contact);

                // if ($contact) {
                //     $query->orWhereHas('shareToContact', function ($q) use ($contact, $allowAccessLevel) {
                //         $q->whereIn($this->sharableKey, [$contact->id]);
                //         $this->shareQueryByREGEXP($q, $this->sharableAccessLevel, $allowAccessLevel);
                //     });
                // }

                // Group condition
                $groups = optional($user->groups);

                if ($groups->count()) {
                    $query->orWhereHas('shareToGroup', function ($q) use ($groups, $allowAccessLevel) {
                        $q->whereIn($this->sharableKey, $groups->pluck('id'));
                        $this->shareQueryByREGEXP($q, $this->sharableAccessLevel, $allowAccessLevel);
                    });
                }
            }
        }

        return $query;
    }

    protected function shareQueryByREGEXP($query, $key, $allowAccessLevel)
    {
        // return $query->whereIn($key, $allowAccessLevel);
        return $query->where(
            $key,
            'REGEXP',
            $this->shareConvertString(
                collect($allowAccessLevel)->filter()->implode(',')
            )
        );
    }

    private function shareConvertString($data) //data = 12,34 or [12, 34] => (12|34)
    {
        if (is_array($data) && count($data)) {
            $explode = $data;

        } else {
            $explode = collect(explode(',', $data))->filter()->toArray();

        }

        if (!count($explode)) {
            return false;
        }

        return '('.implode('|', $explode).')';
        // return '^'.implode('|^', $explode);
    }

    public function getAbleToControllShareSettingAttribute()
    {
        if (backpack_user()->isTopNewRole()) {
            return true;
        }

        $shareToNewRole = $this->shareToNewRole->pluck('id')->toArray() ?? [];

        if (in_array(backpack_user()->new_role_id, $shareToNewRole)) {
            return true;
        }
        // dd($shareToNewRole);
        return false;
    }
}
