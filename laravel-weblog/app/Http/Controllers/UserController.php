<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Requests\UpdatePremiumRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        abort_unless(Auth::user()->id === $user->id, 403, 'Unauthorized action.');

        return view('premium', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePremiumRequest $request, User $user)
    {
        $user->premium = $request->boolean('premium');

        $user->save();

        // $redirectUrl = session('intended_post', route('posts.index'));
        
        return redirect()->intended(route('posts.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
