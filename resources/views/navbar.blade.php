<div class="col-xs-12">
    <nav class="navbar navbar-embossed navbar-inverse" role="navigation">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
            </button>
            <a class="navbar-brand" href="{{ route('index') }}">payste</a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-left">
                <li {!! app('request')->is('/') ? 'class="active"' : '' !!}>
                    <a href="{{ route('index') }}">Paste</a>
                </li>
                <li {!! app('request')->is('faq') ? 'class="active"' : '' !!}>
                    <a href="{{ route('faq') }}">FAQ</a>
                </li>
            </ul>
        </div>
    </nav>
</div>
