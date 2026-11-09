<?php

namespace App\Http\Responses;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\RegisterResponse as RegisterResponseContract;
use Laravel\Fortify\Fortify;
use Symfony\Component\HttpFoundation\Response;

class RegisterResponse implements RegisterResponseContract
{
    /**
     * New accounts start out pending approval. Fortify has already logged the new user in at this
     * point, so log them out again and send them to the login page instead of into the application.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function toResponse($request): Response
    {
        $user = $request->user();

        if ($user instanceof User && $user->isPendingApproval()) {
            Auth::logout();

            if ($request->hasSession()) {
                $request->session()->invalidate();
                $request->session()->regenerateToken();
            }

            return $request->wantsJson()
                ? response()->json(['message' => User::PENDING_APPROVAL_MESSAGE], 202)
                : redirect()->route('login')->with('status', User::PENDING_APPROVAL_MESSAGE);
        }

        // Fortify's default behaviour for accounts that need no approval.
        return $request->wantsJson()
            ? new JsonResponse('', 201)
            : redirect()->intended(Fortify::redirects('register'));
    }
}
