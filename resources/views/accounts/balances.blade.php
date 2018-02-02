@extends('layout')

@section('content')
    <h2>{{ $title }}</h2>
    Huidig saldo: {{ \App\Util::amountToEuro($currentBalance) }}

    <?php $lastYear = 0; ?>
    @if (count($balances) > 0)
        @foreach ($balances as $balance)
            @if ($balance->year != $lastYear)
                @if ($lastYear != 0)
                </table>
                @endif

                <h3>{{ $balance->year }}</h3>
                <table class="table table-striped table-bordered">
                    <tr>
                        <th>Maand</th>
                        <th>Cashflow</th>
                        <th>Nieuw saldo</th>
                    </tr>

                <?php $lastYear = $balance->year; ?>

            @endif

                    <tr>
                        <td>{{ \App\Util::monthNumberToFriendly($balance->month) }}</td>
                        <td>{{ \App\Util::amountToEuro($balance->cashflow) }}</td>
                        <td>{{ \App\Util::amountToEuro($currentBalance) }}</td>
                        <?php $currentBalance -= $balance->cashflow; ?>
                    </tr>

        @endforeach
        </table>
    @endif
@endsection