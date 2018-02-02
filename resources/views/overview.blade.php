@extends('layout')

@section('content')
    <h2>Mutaties per rekening</h2>
    <table class="table table-striped table-bordered">
        @foreach ($accounts as $account)
            @if (count($account->getActiveYears() > 0))
            <tr>
                <td><b><a href="/rekening/{{ $account->id }}/{{ $defaultYear }}">{{ $account->title }}</a></b></td><td><a href="/rekening/{{ $account->id }}">alles</a></td>
                @foreach ($account->getActiveYears('DESC') as $year)
                    <td><a href="/rekening/{{ $account->id }}/{{ $year }}">{{ $year }}</a></td>
                @endforeach
            </tr>
            @endif
        @endforeach
    </table>

    <h2>Maandsaldi per rekening</h2>
    <ul>
        <li><a href="/balances">Alle rekeningen</a></li>
        @foreach ($accounts as $account)
            <li>
                <a href="/balances/{{ $account->id }}">{{ $account->title }}</a>
            </li>
        @endforeach
    </ul>
@endsection