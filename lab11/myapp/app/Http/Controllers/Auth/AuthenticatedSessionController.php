<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Course;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

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
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $this->captureSessionSnapshot($request);

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

    private function captureSessionSnapshot(Request $request): void
    {
        $session = $request->session();
        $user = $request->user();

        $session->put('login_counter', $session->get('login_counter', 0) + 1);
        $session->put('last_login_time', now()->toDateTimeString());
        $session->put('username', $user->name);
        $session->put('role', $user->role ?? 'Learner');

        $latestCourseTitle = Course::where('user_id', $user->id)->latest()->value('title');
        $academicSnapshot = [
            'course' => $latestCourseTitle ?? 'Mini-LMS Foundations',
            'semester' => 'Fall',
            'year' => now()->year,
        ];

        $session->put('academic_snapshot', json_encode($academicSnapshot));
    }
}
