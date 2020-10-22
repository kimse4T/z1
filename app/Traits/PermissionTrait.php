<?php

namespace App\Traits;
trait PermissionTrait{

    function setPermission($crud,$entity)
    {
        $crud->denyAccess(['create','delete','update','show','list']);

        if(backpack_user()->hasPermissionTo('add '.$entity))
        {
            $this->crud->allowAccess(['create']);
        }

        if(backpack_user()->hasPermissionTo('update '.$entity))
        {
            $this->crud->allowAccess(['update']);
        }

        if(backpack_user()->hasPermissionTo('delete '.$entity))
        {
            $this->crud->allowAccess(['delete']);
        }

        if(backpack_user()->hasPermissionTo('list '.$entity))
        {
            $this->crud->allowAccess(['list']);
        }

        if(backpack_user()->hasPermissionTo('show '.$entity))
        {
            $this->crud->allowAccess(['show']);
        }
    }
}
