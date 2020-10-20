<?php
namespace Tests\Traits;

use App\Models\V1\Contacts\Contact;
use App\Models\VerifyCode;
use App\User;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Laravel\Passport\ClientRepository;

trait LoginWithToken
{
    use DatabaseTransactions;

    protected $token;
    protected $dataUser;
    protected $password = '1234';

    /**
    * @before
    */
    public function setUpUser()
    {
        $this->afterApplicationCreated(function() {
            $this->dataUser = factory(User::class)->create([
                'password' => Hash::make($this->password)
            ]);
            $this->token = 'Bearer ' . $this->getToken();
        });
    }

    public function getToken()
    {
        $email= $this->dataUser->email;
        $res = $this->json(
            'POST',
            'api/auth/login',
            [
            'email' => $email,
            'password' => $this->password
            ]
        );

        return $res['access_token'];
    }
}
