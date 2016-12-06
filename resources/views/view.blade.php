@extends('layout')

@section('title', sprintf('Paste created at %s '.env('APP_TIMEZONE', 'UTC'), $created_at))

@push('scripts')
    <script type="text/javascript" defer src="js/view.js"></script>
@endpush

@section('content')
        <div class="col-xs-12">
            <div class="row">
                <div id="paste-container" class="col-xs-12"></div>
                <div id="encrypted-content" style="display: none;">{{ $tabs }}</div>
            </div>
            <div class="row">
                <div class="col-xs-3"></div>
                <div class="col-xs-6" style="margin-top: 10px;">
                    <a class="btn btn-block btn-lg btn-primary" href="/">Create new paste</a>
                </div>
                <div class="col-xs-3"></div>
            </div>
        </div>
@endsection
