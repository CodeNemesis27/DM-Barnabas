<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Actions\RedirectIfTwoFactorAuthenticatable;
use Laravel\Fortify\Fortify;

class EnsureAccountIsApproved extends RedirectIfTwoFactorAuthenticatable
{
    /**
     * Runs once the password is verified (so a wrong password never reveals whether an account
     * exists or is pending) and before any later step can log the user in.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  callable  $next
     * @return mixed
     */
    public function handle($request, $next)
    {
        // Same credential check as Fortify's own two-factor step; a wrong login throws the usual error.
        $user = $this->validateCredentials($request);

        if ($user instanceof User && $user->isPendingApproval()) {
            throw ValidationException::withMessages([
                Fortify::username() => User::PENDING_APPROVAL_MESSAGE,
            ]);
        }

        return $next($request);
    }
}
