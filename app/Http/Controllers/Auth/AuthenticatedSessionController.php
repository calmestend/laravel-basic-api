<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\JsonResponse;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse|JsonResponse
    {
        Log::info('Login request received', $request->all());

        $request->authenticate();

        $request->session()->regenerate();

        $token = $request->user()->createToken('auth_token')->plainTextToken;

        if ($request->expectsJson()) {
            Log::info('User logged in successfully', ['user_id' => $request->user()->id]);
            return response()->json([
                'user'    => $request->user(),
                'access_token' => $token,
                'token_type'   => 'Bearer',
                'message' => 'User logged in successfully',
            ], 200);
        }

        return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
