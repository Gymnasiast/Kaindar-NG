@extends('layout')

@section('content')
    <h1>{{ $account->title }}</h1>

    <div class="dropdown">
        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
            Overige jaren:
            <span class="caret"></span>
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
            @foreach ($years as $year)
                <li><a href="/rekening/{{ $account->id }}/{{ $year }}">{{ $year }}</a></li>
            @endforeach
        </ul>
    </div>

    <br><br>

    <form class="form-horizontal" method="post" action="/mutations">
        {{ csrf_field() }}
        <input type="hidden" name="account_id" value="{{ $account->id }}">

        <div class="form-group">
            <label for="code" class="col-sm-2 control-label">Code: </label>
            <div class="col-sm-2">
                <input id="code" name="code" type="text" class="form-control" required>
            </div>
        </div>

        <div class="form-group">
            <label for="description" class="col-sm-2 control-label">Beschrijving: </label>
            <div class="col-sm-10">

                <input id="description" name="description" type="text" class="form-control">
            </div>
        </div>

        <div class="form-group">
            <label for="day" class="col-sm-2 control-label">Dag: </label>
            <div class="col-sm-2">
                <input id="day" name="day" type="text" class="form-control" maxlength="2" required>
            </div>
        </div>

        <div class="form-group">
            <label for="month" class="col-sm-2 control-label">Maand: </label>
            <div class="col-sm-2">
                <input id="month" name="month" type="text" class="form-control" maxlength="2" required>
            </div>
        </div>

        <div class="form-group">
            <label for="year" class="col-sm-2 control-label">Jaar: </label>
            <div class="col-sm-2">
                <input id="year" name="year" type="text" class="form-control" maxlength="4" placeholder="{{ \App\Setting::getValueByKey('defaultYear') }}">
            </div>
        </div>

        <div class="form-group">
            <label for="amount" class="col-sm-2 control-label">Bedrag: </label>
            <div class="col-sm-2">
                <div class="input-group">
                    <div class="input-group-addon">&euro;</div>
                    <input id="amount" name="amount" type="text" class="form-control" placeholder="0,00" required>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="vat" class="col-sm-2 control-label">BTW: </label>
            <div class="col-sm-2">
                <div class="input-group">
                    <input id="vat" name="vat" type="text" class="form-control" placeholder="0">
                    <div class="input-group-addon">%</div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-10 col-sm-offset-2">
                <button type="submit" class="btn btn-primary">Invoeren</button>
            </div>
        </div>
    </form>

    <br>
    Huidig saldo: {{ \App\Util::amountToEuro($currentBalance) }}
    <br><br>

    @if (count($mutations) > 0)
        <table class="table table-striped table-bordered">
            <tr>
                <th>Post</th>
                <th>Beschrijving</th>
                <th>Datum</th>
                <th>Bedrag</th>
                <th>BTW</th>
                <th class="actionsColumn">Acties</th>
            </tr>

            @foreach ($mutations as $mutation)
                <tr>
                    <td>
                        {{ $mutation->getCodeName() }}
                    </td>
                    <td>{{ $mutation->description }}</td>
                    <td>{{ $mutation->dateFriendly() }}</td>
                    <td>{{ $mutation->amountFriendly() }}</td>
                    <td>
                        @if ($mutation->vat > 0.0)
                            {{ $mutation->vatFriendly() }} %
                        @endif
                    </td>
                    <td>
                        <div class="btn-group">
                            <a role="button" class="btn btn-default btn-sm" title="Bewerken">
                                <span class="glyphicon glyphicon-pencil"></span>
                            </a>
                            <a role="button" class="btn btn-default btn-sm btn-danger" title="Verwijderen">
                                <span class="glyphicon glyphicon-trash"></span>
                            </a>
                        </div>

                    </td>
                </tr>
            @endforeach
        </table>
    @endif

@endsection