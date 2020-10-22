<?php

namespace Tests\Traits;

use Illuminate\Support\Facades\Hash;

trait LoginTrait{

    protected $response;

    function assertLoginFailed($response)
    {
        $response->assertSessionHasErrors('email');
        $this->assertTrue(session()->hasOldInput('email'));
        $this->assertFalse(session()->hasOldInput('password'));
        $response->assertRedirect('/admin/login');
    }


}
