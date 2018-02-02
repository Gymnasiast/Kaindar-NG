@extends('layout')

@section('content')
    <h2>Instellingen</h2>
    <ul>
        @foreach ($settings as $setting)
            <li>
                {{ $setting->getFriendlyName() }}: {{ $setting->value }}
            </li>
        @endforeach
    </ul>

    <h2>Informatie</h2>
    <ul>
        <li>Versie: 2.0 alpha 0</li>
    </ul>

@endsection