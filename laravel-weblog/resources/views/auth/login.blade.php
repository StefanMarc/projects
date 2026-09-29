@extends('layouts.app')

@section('title', 'Page Title')

@section('content')
   <h1>login page</h1>
   <form class="login-form" action="" method="">
        @csrf
        <div class="field-group">
            <label for="username">Email</label>
            <input type="text" name="username" id="username" required>
        </div>

        <div class="field-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required>
        </div>

        <button type="submit">Log in</button>

    </form>
@endsection