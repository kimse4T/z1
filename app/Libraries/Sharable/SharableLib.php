<?php

namespace App\Libraries\Sharable;

class SharableLib
{
    public function onCreate($entry, $type, $loginUser = false, $accessLevel = false)
    {
        if (!$loginUser) {
            $loginUser = backpack_user();
        }

        if (!$loginUser->new_role_id) { // don't do any if user no new_role_id
            return false;
        }

        if (!$accessLevel) {
            $accessLevel = config('const.options.sharable.access_levels.all');
        }
        // dd($this->setSyncIdWithAccessLevel($loginUser, $accessLevel));
        // dd($loginUser->newRole->descendants);
        // switch($type) {
        //     case config('const.options.sharable.new_role'):
        //         // return $entry->shareToNewRole()->sync(
        //         return $entry->shareToNewRole()->syncWithoutDetaching(
        //             $this->setSyncIdWithAccessLevel($type, $loginUser, $accessLevel));
        //     break;

        //     case config('const.options.sharable.user'):
        //         // TO DO or NOT USE
        //         return $entry->shareToUser()->syncWithoutDetaching(
        //             $this->setSyncIdWithAccessLevel($type, $loginUser, $accessLevel));
        //     break;

        //     case config('const.options.sharable.contact'):
        //         // TO DO or NOT USE
        //         return false;
        //     break;

        //     case config('const.options.sharable.group'):
        //         // TO DO or NOT USE
        //         return $entry->shareToGroup()->syncWithoutDetaching(
        //             $this->setSyncIdWithAccessLevel($type, $loginUser, $accessLevel));
        //     break;
        // }

        $model = $this->switchRelationshoip($type, $entry);
        if (!$model) {
            return false;
        }
        return $model->syncWithoutDetaching($this->setSyncIdWithAccessLevel($type, $loginUser, $accessLevel));
        // return $entry->sharable()->sync($this->setSyncIdWithAccessLevel($type, $loginUser, $accessLevel));
    }

    public function switchRelationshoip($type, $entry)
    {
        switch($type) {
            case config('const.options.sharable.new_role'):
                return $entry->shareToNewRole();
            break;

            case config('const.options.sharable.contact'):
                return $entry->shareToContact();
            break;

            case config('const.options.sharable.user'):
                return $entry->shareToUser();
            break;

            case config('const.options.sharable.group'):
                return $entry->shareToGroup();
            break;

            default:
                return false;
            break;
        }
    }
    /**
     *
     */
    public function onSingleOperation($entry, $type, $typeId, $accessLevel, $operation = 'syncWithoutDetaching')
    {

        $model = $this->switchRelationshoip($type, $entry);
        if (!$model) {
            return false;
        }
        if ($operation === 'syncWithoutDetaching') {
            return $model->syncWithoutDetaching([
                $typeId => [
                    'access_level' => $this->accessLevelStringConversion($accessLevel),
                    'sharable_type' => $type
                ]
            ]);
        }

        if ($operation === 'updateExistingPivot') {
            return $model->updateExistingPivot($typeId, ['access_level' => $this->accessLevelStringConversion($accessLevel)]);
        }

        if ($operation === 'detact') {
            return $model->detach($typeId);
        }

        return false;
        // return $entry->sharable()->sync($this->setSyncIdWithAccessLevel($type, $loginUser, $accessLevel));
    }

    public function accessLevelStringConversion(Array $accessLevels)
    {
        $strAccessLevel = [];
        foreach($accessLevels as $al) {
            $strAccessLevel[] = "$al";
        }
        return implode(',', $strAccessLevel);
    }

    public function setSyncIdWithAccessLevel($type, $loginUser, $accessLevel)
    {
        $syncData = [];
        $newRoleAllIdsByLogin = $this->newRoleAllIdsByLogin($loginUser, 'pluck');

        if ($newRoleAllIdsByLogin->count()) {
            foreach($newRoleAllIdsByLogin as $v):
                $syncData[$v] = ['access_level' => $accessLevel, 'sharable_type' => $type];
            endforeach;
        }

        return $syncData;
    }

    public function newRoleAllIdsByLogin($loginUser, $type = 'pluck')
    {
        $ids = null;
        $userRole = optional($loginUser->newRole);

        if (!$loginUser) {
            $loginUser = backpack_user();
        }

        if ($userRole) {
            $ids = $userRole->ancestors->pluck('id')->push($loginUser->new_role_id)->filter()->unique();

            if ($type === 'array') {
                $ids = $ids->toArray();
            }
        }

        return $ids;
    }
}
