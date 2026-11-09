<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\ValidationException;
use Laravel\Sanctum\PersonalAccessToken;

class AuthController extends Controller
{
    /** How long a mobile session stays valid. The app signs the user out when the token expires. */
    private const TOKEN_LIFETIME_DAYS = 30;

    public function login(Request $request): JsonResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
            'device_name' => ['required', 'string', 'max:100'],
        ]);

        $user = User::query()->where('email', $credentials['email'])->first();

        if (! $user || ! Hash::check($credentials['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => [trans('auth.failed')],
            ]);
        }

        if ($this->isPendingVerification($user)) {
            return response()->json([
                'message' => 'Your account is pending verification. Please contact your administrator.',
            ], 403);
        }

        $token = $user->createToken(
            $credentials['device_name'],
            ['*'],
            now()->addDays(self::TOKEN_LIFETIME_DAYS),
        );

        return response()->json([
            'token' => $token->plainTextToken,
            'token_type' => 'Bearer',
            'user' => new UserResource($user),
        ]);
    }

    public function me(Request $request): JsonResponse
    {
        return response()->json([
            'user' => new UserResource($request->user()),
        ]);
    }

    public function logout(Request $request): JsonResponse
    {
        $token = $request->user()->currentAccessToken();

        if ($token instanceof PersonalAccessToken) {
            $token->delete();
        }

        return response()->json(['message' => 'Signed out.']);
    }

    /**
     * Same rule as the web login: an account that has neither approved_by nor approved_at is still
     * waiting for verification. The check only applies once those columns exist on the users table.
     */
    private function isPendingVerification(User $user): bool
    {
        if (! Schema::hasColumns('users', ['approved_by', 'approved_at'])) {
            return false;
        }

        return $user->approved_by === null && $user->approved_at === null;
    }
}
