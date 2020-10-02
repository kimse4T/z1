<?php

namespace App\Libraries\Sharable;

trait SharableRepositoryTrait
{
    // View
    public function shareAllowView($id)
    {
        return $this->shareAllow($id, 'IsSharableRead');
    }

    public function shareAbortView($id, $status = 403)
    {
        return $this->shareNotAllow($id, 'shareAllowView', $status);
    }

    // Update
    public function shareAllowUpdate($id)
    {
        return $this->shareAllow($id, 'IsSharableUpdate');
    }

    public function shareAbortUpdate($id, $status = 403)
    {
        return $this->shareNotAllow($id, 'shareAllowUpdate', $status);
    }

    // Delete
    public function shareAllowDelete($id)
    {
        return $this->shareAllow($id, 'IsSharableDelete');
    }

    public function shareAbortDelete($id, $status = 403)
    {
        return $this->shareNotAllow($id, 'shareAllowDelete', $status);
    }

    // All
    public function shareAllowAll($id)
    {
        return $this->shareAllow($id, 'IsSharableAll');
    }

    public function shareAbortAll($id, $status = 403)
    {
        return $this->shareNotAllow($id, 'shareAllowAll', $status);
    }

    // Helper
    public function shareNotAllow($id, $method = 'shareAllowAll', $status = 403)
    {
        if ($this->{$method}($id)) {
            return false;
        }

        return abort($status);
    }

    public function shareAllow($id, $scope = 'IsSharableAll')
    {
        return $this->model->{$scope}()->where('id', $id)->count();
    }
}
