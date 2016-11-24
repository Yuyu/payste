const editors = [];
const modeData = [];
var modeSelect;

$(window).bind('load', function() {
    CodeMirror.modeURL = 'js/mode/%N/%N.js';

    CodeMirror.modeInfo.forEach(meta => {
        modeData.push({id: meta.mime, mode: meta.mode, text: meta.name});
    });

    addEditorTab();

    if ($('[data-toggle="select"]').length) {
         modeSelect = $('[data-toggle="select"]').select2({
            data: modeData,
            dropdownCssClass: 'show-select-search'
        });

        modeSelect.on('change', e => {
            let editor = editors[$('#tab-list li.active a').data('id')],
                mode = e.val || modeSelect.val() || 'text/plain';

            editor.setOption('mode', mode);
            CodeMirror.autoLoadMode(editor, CodeMirror.findModeByMIME(mode).mode);

            editor.focus();
        });

        modeSelect.val('text/plain').trigger('change');
    }
});

function doPaste() {
    let data = {
        tabs: [],
    };

    var password = generatePassword();

    for (let id in editors) {
        data.tabs.push({
            title: $('a[href="#tab-editor-'+id+'"] span:first-child').html(),
            content: editors[id].getValue(),
            syntax: editors[id].getOption('mode')
        });
    }

    data.tabs = encryptContent(JSON.stringify(data.tabs), password);

    $.post('/', data, resp => {
        if (resp) {
            const uri = resp+'#'+password;
            location.assign(uri);
        }
    });
}

function createEditor(target, mode) {
    return CodeMirror.fromTextArea(target, {
        lineNumbers: true,
        theme: 'solarized',
        mode: mode,
        indentUnit: 4,
        autofocus: true
    });;
}

function addEditorTab() {
    const length = editors.length;

    if (length >= 10) {
        return;
    } else if (length === 0) {
        var mode = 'text/plain';
    } else {
        let activeId = $('#tab-list li.active a').data('id');
        var mode = editors[activeId].getOption('mode');
    }

    const id = generatePassword(6);

    $('#tab-list li:last').before($('<li><a href="#tab-editor-'+id+'" role="tab" data-toggle="tab" data-id="'+id+'"><span>Untitled</span><span class="glyphicon glyphicon-pencil" style="margin-left: 6px; cursor: pointer; font-size: 11pt;"></span><span class="glyphicon glyphicon-remove" style="margin-left: 2px; cursor: pointer; font-size: 11pt;"></span></a></li>'));
    $('#tab-content').append($('<div role="tabpanel" class="tab-pane" id="tab-editor-'+id+'"><textarea id="editor-'+id+'" class="form-control"></textarea></div>'));

    $('a[href="#tab-editor-'+id+'"]').tab('show');
    editors[id] = createEditor(document.getElementById('editor-'+id), mode);

    $('a[href="#tab-editor-'+id+'"]').on('shown.bs.tab', switchSyntaxBox);

    $('.glyphicon-pencil').off('click');
    $('.glyphicon-pencil').click(tabEdit);

    $('.glyphicon-remove').off('click');
    $('.glyphicon-remove').click(tabRemove);
}

function switchSyntaxBox(e) {
    const id = $(e.target).data('id'),
        mode = editors[id].getOption('mode');
    modeSelect.val(mode).trigger('change');
}

function tabEdit() {
    const pen = $(this);
    pen.css('visibility', 'hidden');
    $(this).prev().attr('contenteditable', 'true').focusout(function() {
        $(this).removeAttr('contenteditable').off('focusout').off('keydown');
        pen.css('visibility', 'visible');

        let modeSuggestion = CodeMirror.findModeByFileName($(this).html());
        if (modeSuggestion) {
            modeSelect.val(modeSuggestion.mime).trigger('change');
        }
    }).keydown(function(e) {
        if (e.keyCode == 13) {
            $(this).focusout();
            return false;
        }
    });
    $(this).prev().focus();
    document.execCommand('selectAll', false, null);
}

function tabRemove() {
    const tabIndex = $(this.parentElement.parentElement).index(),
        isActive = $(this.parentElement.parentElement).hasClass('active'),
        newIndex = tabIndex === 0 ? 1 : tabIndex;
    let id = $(this.parentElement).data('id');

    delete editors[id];
    $(this.parentElement.parentElement).remove();
    $('#tab-editor-'+id).remove();

    if (isActive) {
        $('#tab-list li:nth-child('+newIndex+') a').click();
    }
}
