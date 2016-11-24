$(window).bind("load", function(){

    CodeMirror.modeURL = 'js/mode/%N/%N.js';
    const editors = [];

    if ($('#encrypted-content').length) {
        updateContent();
    }

    function updateContent() {
        if (location.hash) {
            let content = $('#encrypted-content').html();
            const password = location.hash.slice(1);

            content = JSON.parse(decryptContent(content, password));

            $('#paste-container').empty()
                .append('<ul class="nav nav-tabs" role="tablist" id="tab-list"></ul>')
                .append('<div class="tab-content" id="tab-content"></div>');

            for (let i = 0, len = content.length; i < len; i++) {
                let tab = content[i];
                $('#tab-content').append('<div role="tabpanel" class="tab-pane active" id="tab-editor'+i+'"><textarea id="editor'+i+'" class="form-control" data-syntax="'+tab.syntax+'"></textarea></div>');
                $('#tab-list').append('<li><a href="#tab-editor'+i+'" role="tab" data-toggle="tab"><span>'+tab.title+'</span></a></li>');
                $('#editor'+i).text(tab.content);
                $('a[href="#tab-editor'+i+'"]').tab('show');
                editors[i] = CodeMirror.fromTextArea(document.getElementById('editor'+i), {
                    lineNumbers: true,
                    value: $('#editor'+i).val(),
                    theme: 'solarized',
                    mode: tab.syntax,
                    indentUnit: 4,
                    autofocus: true,
                    readOnly: true
                });
                CodeMirror.autoLoadMode(editors[i], CodeMirror.findModeByMIME(tab.syntax).mode);
            }

            $('#tab-list a').on('shown.bs.tab', function(e) {
                editors[$('#tab-list li.active').index()].refresh();
            });

            $('a[href="#tab-editor0"]').tab('show');
        }
    }

    window.onhashchange = updateContent;
});
