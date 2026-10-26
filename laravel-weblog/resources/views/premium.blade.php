@extends('layouts.app')

@section('title', 'Page Title')

@section('content')
<h1>you are in luck, premium is free!</h1>
<p>test it out indefinitely by signing up below</p>
<form action="{{ route('user.upgrade') }}" method="POST">
    @csrf
    @method('PUT')

    <fieldset>
        <div class="checkbox-group">
            <input type="checkbox"
            name="premium"
            id="premium"
            value="1"
            >
            <label for="premium">I want to be a premium member!</label>
        </div>
        <button type="submit">save</button>
    </fieldset>
</form>
@endsection