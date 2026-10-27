@extends('layouts.app')

@section('title', 'Page Title')

@section('content')
@if (Auth::check() && !Auth::user()->premium)
    <h1>You are in luck, premium is free!</h1>
    <div class="premium-page">
        <p>Test it out indefinitely by signing up below.</p>
        <form action="{{ route('user.upgrade') }}" method="POST">
            @csrf
            @method('PUT')

            <fieldset class="premium-signup">
                <div class="checkbox-group">
                    <input type="checkbox"
                    name="premium"
                    id="premium"
                    value="1"
                    >
                    <label for="premium">I want to be a premium member!</label>
                </div>
                <button type="submit">Pay €0,- now!</button>
            </fieldset>
        </form>
    </div>

@elseif (Auth::check() && Auth::user()->premium)
    <h1>We are sorry to see you go.</h1>
    <div class="premium-page">
        <p>Unsubscribe by clicking the button below.</p>
        <form action="{{ route('user.upgrade') }}" method="POST">
            @csrf
            @method('PUT')

            <fieldset class="premium-signup">
                <div class="checkbox-group">
                    <input type="checkbox"
                    name="premium"
                    id="premium"
                    value="0"
                    >
                    <label for="premium">I want to unsubscribe</label>
                </div>
                <button type="submit">Cancel subscription</button>
            </fieldset>
        </form>
    </div>
@endif

@endsection