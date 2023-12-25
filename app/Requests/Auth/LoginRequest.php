<?php

declare(strict_types=1);

namespace Denosys\App\Requests\Auth;

use Denosys\Core\Http\FormRequest;
use Denosys\App\Services\UserAuthenticationService;

class LoginRequest extends FormRequest
{

    protected UserAuthenticationService $auth;

    public function __construct(UserAuthenticationService $auth)
    {
        $this->auth = $auth;
    }

    public function rules(): array
    {
        return [
            'username' => ['required'],
            'password' => ['required']
        ];
    }

    public function authenticate(): void
    {
        $this->validate();

        $this->auth->login($this->validated());
    }
}