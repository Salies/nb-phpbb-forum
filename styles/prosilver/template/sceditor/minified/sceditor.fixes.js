// Remove the opening break on list tags too

$.sceditor.command.set("spoiler", {
    exec: function() {
        var editor = this;
        $( ".sceditor-spoiler" ).toggle();
            $('#enviar').click(function(){
                var titulo_spoiler = $('#spoilv').val();    
                if(!titulo_spoiler){
                    var spoil_saida = '[spoiler][/spoiler]';
                }
                else{
                    var spoil_saida = '[spoiler="' + titulo_spoiler + '"][/spoiler]';
                }
                editor.insert(spoil_saida);
                $( ".sceditor-spoiler" ).toggle();
                $('#spoilv').val() = null;           
            });
    },
    txtExec: function() {
            var editor = this;
            $( ".sceditor-spoiler" ).toggle();
            $('#enviar').click(function(){
                var titulo_spoiler = $('#spoilv').val();
                if(!titulo_spoiler){
                    var spoil_saida = '[spoilersss][/spoilersss]';
                }
                else{
                    var spoil_saida = '[spoiler="' + titulo_spoiler + '"][/spoiler]';
                }
                editor.insert(spoil_saida);
                $( ".sceditor-spoiler" ).toggle();
                $('#spoilv').val() = null;
            });
    },
    tooltip: "Spoiler",
});

$.sceditor.plugins.bbcode.bbcode.set("size", {
    format: function($element, content) {
        var size = $element.css('font-size').replace('px', '');
        return '[size=' + size + ']' + content + '[/size]';
    },
    html: function(token, attrs, content) {
        return '<span style="font-size: ' + attrs.defaultattr + 'px">' + content + '</span>';
    }
});

    $.sceditor.command.set("image", {
        exec: function (caller) {
            var editor  = this,
                content = _tmpl('image', {
                    url: editor._('URL:'),
                    insert: editor._('Insert')
                }, true);

            content.find('.button').click(function (e) {
                var val = content.find('#image').val();

                if(val && val !== 'http://')
                    editor.wysiwygEditorInsertHtml('<img src="' + val + '" />');

                editor.closeDropDown(true);
                e.preventDefault();
            });

            editor.createDropDown(caller, 'insertimage', content);
        },
        tooltip: 'Insert an image'
    });
    var _tmpl = function(name, params, createHTML) {
        var _templates = {
            image: '<div><label for="link">{url}</label> <input type="text" id="image" value="http://" /></div>' +
                '<div><input type="button" class="button" value="{insert}" /></div>'
        }
    
        var template = _templates[name];

        $.each(params, function(name, val) {
            template = template.replace(new RegExp('\\{' + name + '\\}', 'g'), val);
        });

        if(createHTML)
            template = $(template);

        return template;
    };


$.sceditorBBCodePlugin.bbcode
                    .set('list', { breakStart: false })
                    .set('ul', { breakStart: false })
                    .set('ul', { breakAfter: false })
                    .set('ol', { breakStart: false })
                    .set('ol', { breakAfter: false })
                    .set('li', { breakAfter: false })
                    .set('table', { breakStart: false })
                    .set('table', { breakAfter: false })
                    .set('code', { breakStart: false })
                    .set('code', { breakAfter: false })
                    .set('tr', { breakStart: false })
                    .set('tr', { breakAfter: false })
                    .set('td', { breakStart: false })
                    .set('td', { breakAfter: false })
                    .set('center', { breakStart: false })
                    .set('center', { breakAfter: false })
                    .set('left', { breakStart: false })
                    .set('left', { breakAfter: false })    
                    .set('right', { breakStart: false })
                    .set('right', { breakAfter: false })                  
                    ;