<?php

namespace App\Libraries\Sharable;

use App\Http\Controllers\Admin\Backpacks\Permissions\Model\NewRole;

trait HasSharableTrait
{
    public function hasAnyNewRole(...$roles)
    {
        return $this->hasNewRole($roles);
    }
    
    /**
     * @param string|int|array $roles
     * @param boolean $enableDepth
     * 
     * @return boolean
     */
    public function hasNewRole($roles, $enableDepth = false)
    {
        if (is_string($roles) && false !== strpos($roles, '|')) {
            $roles = $this->convertPipeToArray($roles); // this method convertPipeToArray get from HasRole Package
        }
        // dd($roles);
        if (is_string($roles)) {
            return $this->isNewRoleValueCorrect($enableDepth ? 'depth' : 'name', $roles);
        }

        if (is_int($roles)) {
            return $this->isNewRoleValueCorrect($enableDepth ? 'depth' : 'id', $roles);
        }

        if (is_array($roles)) {
            foreach ($roles as $role) {
                if ($this->hasNewRole($role)) {
                    return true;
                }
            }

            return false;
        }

        return $isHasRole;
    }

    /**
     * @param string $type: db column name
     * @param mixed $value
     * 
     * @return boolean
     */
    protected function isNewRoleValueCorrect($type, $value)
    {
        $newRole = optional($this->newRole);
        if ($newRole) {
            try {
                return $newRole->{$type} == $value;
            } catch (\Throwable $th) {
                \Log::error($th);
            }
        }

        return false;
    }

    public function isTopNewRole()
    {
        // All New role depth = 1 is top level
       return $this->hasNewRole(1, true);
    }
}