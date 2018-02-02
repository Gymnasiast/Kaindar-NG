<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed " data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">Administratie</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                       aria-haspopup="true" aria-expanded="false">Rekeningen <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        @foreach(\App\Account::all() as $account)
                            <li><a href="/rekening/{{ $account->id }}/{{ \App\Setting::getValueByKey('defaultYear') }}">{{ $account->title }}</a></li>
                        @endforeach
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                       aria-haspopup="true" aria-expanded="false">Maandsaldi <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="/balances">Alle rekeningen</a></li>
                        @foreach(\App\Account::all() as $account)
                            <li><a href="/balances/{{ $account->id }}">{{ $account->title }}</a></li>
                        @endforeach
                    </ul>
                </li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li><a href="/instellingen"><span class="glyphicon glyphicon-cog"></span> Instellingen</a></li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>