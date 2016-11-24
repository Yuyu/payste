@extends('layout')
@section('title', 'payste FAQ')

@section('content')
    <div class="col-xs-12">
        <h1>FAQ</h1>
        <div class="panel-group" role="tablist" id="faq-index">
            <div class="panel panel-default">
                <div class="panel-heading" role="tab">
                    <h4 class="panel-title">
                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#faq-index" href="#faqOne">How does the encryption work?</a>
                    </h4>
                </div>
                <div id="faqOne" class="panel-collapse collapse" role="tabpanel">
                    <div class="panel-body">
                        A password is randomly generated for you, which is then used to en- and decrypt your paste using AES. This randomly generated password never leaves your own browser, so you are the only person who knows it. It's the part after the # in your URL, and without it, you will only see base64-encrypted binary data. <br> All of those functions (except the actual AES implementation, which can be found in the source of <a href="https://code.google.com/archive/p/crypto-js/" target="_blank">CryptoJS</a>) are defined in <a href="js/encryption.js">js/encryption.js</a>.
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading" role="tab">
                    <h4 class="panel-title">
                        <a role="button" data-toggle="collapse" data-parent="#faq-index" href="#faqTwo">Do you store any metadata about my pastes?</a>
                    </h4>
                </div>
                <div id="faqTwo" class="panel-collapse collapse" role="tabpanel">
                    <div class="panel-body">
                        No! All I store is the encrypted content and when the paste was made. No IP addresses or other metadata are stored.
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
