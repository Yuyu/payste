@extends('layout')

@section('title', 'payste')

@push('scripts')
    <script type="text/javascript" defer src="js/index.js"></script>
@endpush

@section('content')
    <div class="col-xs-12">
        <form class="form">
            <div class="form-group row">
                <div class="col-xs-12">
                    <ul class="nav nav-tabs" role="tablist" id="tab-list">
                        <li id="add-editor-button"><a onclick="addEditorTab()" href="#"><span class="glyphicon glyphicon-plus"></span></a></li>
                    </ul>
                    <div class="tab-content" id="tab-content">
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-xs-3">
                    <div class="btn btn-block btn-lg btn-primary" onclick="doPaste()">Paste!</div>
                </div>
                <div class="col-xs-9 text-right" style="margin-top: -28px;">
                    <label for="modes">Syntax scheme:
                        <input type="hidden" id="modes" class="form-control select select-primary" data-toggle="select">
                    </label>
                </div>
            </div>
        </form>
    </div>
@endsection
