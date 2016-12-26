jQuery(document).ready(function($) {

    tinymce.create('tinymce.plugins.bwl_pvm', {
        init: function(ed, url) {
            ed.addButton('bwl_pvm', {
                title: 'BWL Pro Voting Shortcode Editor',
                image: url + '/icons/bwl-pvm-editor-icon.png',
                onclick: function() {
               
                    if ($('#shortcode_controle').length) {
                       
                        $('#shortcode_controle').remove();
                    }
                    else
                    {
                      
                        $('body').append('<div id="bwl_pvm_editor_overlay"><div id="bwl_pvm_editor_popup"></div></div>');

                        $('#bwl_pvm_editor_popup').load(url + '/bwl_pvm_shortcode_editor.php');

                        $('#bwl_pvm_editor_popup').css('margin-top', $(window).height() / 2 - $('#bwl_pvm_editor_popup').height() / 2);

                    }
                }
            });
        },
        createControl: function(n, cm) {
            return null;
        }
    });
    
    tinymce.PluginManager.add('bwl_pvm', tinymce.plugins.bwl_pvm);

});