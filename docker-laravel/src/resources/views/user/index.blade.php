@php
    $title = __('Users');
@endphp
@extends('layouts.app')
@section('content')
<div class="container">
    <h1>{{ $title }}</h1>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>{{ __('ID') }}</th>
                    <th>{{ __('Name') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td><a href="{{ url('user/'.$user->id) }}">{{ $user->name }}</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $users->onEachSide(5)->links() }}
</div>
@endsection
