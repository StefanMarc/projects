@extends('layouts.app')

@section('title', 'Page Title')

@section('content')
   <h1>login page</h1>
   <form class="login-form" action="{{ route('authenticate') }}" method="POST">
        @csrf
        <div class="field-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" required value="{{ old('email') }}">
        </div>

        <div class="field-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required>
        </div>

        <button type="submit">Log in</button>
    </form>

    @if ($errors->any())
        <div class="error-messages">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
@endsection