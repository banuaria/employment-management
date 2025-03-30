import tinymce from 'tinymce/tinymce.min.js';
import 'tinymce/themes/silver/theme.min.js';
import 'tinymce/models/dom/model.min.js';
import 'tinymce/skins/content/default/content.min.css';
import 'tinymce/skins/content/default/content.js';
import 'tinymce/skins/ui/oxide/skin.min.css';
import 'tinymce/skins/ui/oxide/skin.js';
import 'tinymce/icons/default/icons.min.js';
import 'tinymce/plugins/advlist/plugin.min.js';
import 'tinymce/plugins/autolink/plugin.min.js';
import 'tinymce/plugins/lists/plugin.min.js';
import 'tinymce/plugins/link/plugin.min.js';
import 'tinymce/plugins/image/plugin.min.js';
import 'tinymce/plugins/charmap/plugin.min.js';
import 'tinymce/plugins/anchor/plugin.min.js';
import 'tinymce/plugins/searchreplace/plugin.min.js';
import 'tinymce/plugins/visualblocks/plugin.min.js';
import 'tinymce/plugins/code/plugin.min.js';
import 'tinymce/plugins/insertdatetime/plugin.min.js';
import 'tinymce/plugins/media/plugin.min.js';
import 'tinymce/plugins/table/plugin.min.js';
import 'tinymce/plugins/help/plugin.min.js';
import 'tinymce/plugins/help/js/i18n/keynav/en.js';
import 'tinymce/plugins/wordcount/plugin.min.js';

function tinymceTextarea() {
    tinymce.remove();
    tinymce.init({
        selector: "textarea.tinymce-textarea",
        height: 480,
        license_key: "gpl",
        promotion: false,
        branding: false,
        skin: false,
        image_caption: true,
        plugins: "advlist autolink lists link image charmap anchor searchreplace visualblocks code insertdatetime media table help wordcount",
        toolbar1: "undo redo | styles bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent",
        toolbar2: "link unlink anchor | image media | forecolor backcolor  | print code",
        convert_urls : false,
        body_class: "tinymce-content",
        content_style: ".tinymce-content h1,.tinymce-content h2,.tinymce-content h3,.tinymce-content h4,.tinymce-content h5,.tinymce-content h6,.tinymce-content ol,.tinymce-content p{display:block;margin-inline-start:0;margin-inline-end:0}"+
            ".tinymce-content a,.tinymce-content a:hover{text-decoration:underline}"+
            ".tinymce-content{font-family:Figtree,ui-sans-serif,system-ui,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol','Noto Color Emoji';line-height:1.6;color:#333;word-wrap:break-word}"+
            ".tinymce-content h1{font-size:2em;margin-block-start:0.67em;margin-block-end:0.67em;font-weight:700}"+
            ".tinymce-content h2{font-size:1.5em;margin-block-start:0.83em;margin-block-end:0.83em;font-weight:700}"+
            ".tinymce-content h3{font-size:1.17em;margin-block-start:1em;margin-block-end:1em;font-weight:700}"+
            ".tinymce-content h4{margin-block-start:1.33em;margin-block-end:1.33em;font-weight:700}"+
            ".tinymce-content h5{font-size:.83em;margin-block-start:1.67em;margin-block-end:1.67em;font-weight:700}"+
            ".tinymce-content h6{font-size:.67em;margin-block-start:2.33em;margin-block-end:2.33em;font-weight:700}"+
            ".tinymce-content blockquote,.tinymce-content ol,.tinymce-content p,.tinymce-content table{margin-block-start:1em;margin-block-end:1em}"+
            ".tinymce-content dir,.tinymce-content menu,.tinymce-content ul{display:block;list-style-type:disc;padding-inline-start:40px;margin-block-start:1em;margin-block-end:1em;margin-inline-start:0;margin-inline-end:0}"+
            ".tinymce-content ol{list-style-type:decimal;padding-inline-start:40px}"+
            ".tinymce-content ol li,.tinymce-content summary,.tinymce-content ul li{display:list-item}"+
            ".tinymce-content a{color:-webkit-link;cursor:auto}"+
            ".tinymce-content blockquote{display:block;margin-inline-start:40px;margin-inline-end:40px}"+
            ".tinymce-content img{vertical-align:middle;max-width:100%;height:auto}"+
            ".tinymce-content table{display:table;border-collapse:separate;border-spacing:2px;border-color:grey;margin-inline-start:0;margin-inline-end:0;border-width:1px}"+
            ".tinymce-content td,.tinymce-content th{display:table-cell;vertical-align:inherit;padding:5px;border:1px inset grey}"+
            ".tinymce-content pre{display:block;white-space:pre;margin:1em 0}"+
            ".tinymce-content hr{display:block;margin-block-start:0.5em;margin-block-end:0.5em;margin-inline-start:auto;margin-inline-end:auto;border-style:inset;border-width:1px}"+
            ".tinymce-content abbr[title]{border-bottom:none;text-decoration:underline dotted}"+
            ".tinymce-content b,.tinymce-content strong{font-weight:bolder}"+
            ".tinymce-content dfn{font-style:italic}"+
            ".tinymce-content mark{background-color:#ff0;color:#000}"+
            ".tinymce-content small{font-size:80%}"+
            ".tinymce-content sub,.tinymce-content sup{font-size:75%;line-height:0;position:relative;vertical-align:baseline}"+
            ".tinymce-content sub{bottom:-.25em}"+
            ".tinymce-content sup{top:-.5em}"+
            ".tinymce-content figure{margin:auto;font-style:italic;font-size:90%}"+
            ".tinymce-content img{border-style:none}"+
            ".tinymce-content code,.tinymce-content kbd,.tinymce-content pre,.tinymce-content samp{font-family:monospace,monospace;font-size:1em}"+
            ".tinymce-content audio,.tinymce-content canvas,.tinymce-content iframe,.tinymce-content img,.tinymce-content svg,.tinymce-content video{display:inline-block}"+
            ".tinymce-content iframe{width:100%;max-width:1024px;border:none;margin-block-start:1em;margin-block-end:1em;margin-inline-start:0px;margin-inline-end:0px;}"+
            ".tinymce-content audio:not([controls]){display:none;height:0}"+
            ".tinymce-content svg:not(:root){overflow:hidden}"+
            ".tinymce-content button,.tinymce-content input,.tinymce-content optgroup,.tinymce-content select,.tinymce-content textarea{font-family:sans-serif;font-size:100%;line-height:1.15;margin:0}"+
            ".tinymce-content button,.tinymce-content input{overflow:visible}"+
            ".tinymce-content button,.tinymce-content select{text-transform:none}"+
            ".tinymce-content [type=button],.tinymce-content [type=reset],.tinymce-content [type=submit],.tinymce-content button{-webkit-appearance:button}"+
            ".tinymce-content [type=button]::-moz-focus-inner,.tinymce-content [type=reset]::-moz-focus-inner,.tinymce-content [type=submit]::-moz-focus-inner,.tinymce-content button::-moz-focus-inner{border-style:none;padding:0}"+
            ".tinymce-content [type=button]:-moz-focusring,.tinymce-content [type=reset]:-moz-focusring,.tinymce-content [type=submit]:-moz-focusring,.tinymce-content button:-moz-focusring{outline:ButtonText dotted 1px}"+
            ".tinymce-content fieldset{padding:.35em .75em .625em}"+
            ".tinymce-content [type=checkbox],.tinymce-content [type=radio],.tinymce-content legend{box-sizing:border-box;padding:0}"+
            ".tinymce-content legend{color:inherit;display:table;max-width:100%;white-space:normal}"+
            ".tinymce-content progress{display:inline-block;vertical-align:baseline}"+
            ".tinymce-content textarea{overflow:auto}"+
            ".tinymce-content [type=number]::-webkit-inner-spin-button,.tinymce-content [type=number]::-webkit-outer-spin-button{height:auto}"+
            ".tinymce-content [type=search]{-webkit-appearance:textfield;outline-offset:-2px}"+
            ".tinymce-content [type=search]::-webkit-search-cancel-button,.tinymce-content [type=search]::-webkit-search-decoration{-webkit-appearance:none}"+
            ".tinymce-content ::-webkit-file-upload-button{-webkit-appearance:button;font:inherit}"+".tinymce-content details{display:block}"+
            ".tinymce-content [hidden],.tinymce-content template{display:none}",
        file_picker_callback: function (callback, value, meta) {
            let x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
            let y = window.innerHeight || document.documentElement.clientHeight || document.getElementsByTagName('body')[0].clientHeight;

            const base_url = window.location.origin;
            let lfmUrl = base_url + '/cms/laravel-filemanager?editor=' + meta.fieldname;

            if (meta.filetype == 'image') {
                lfmUrl = lfmUrl + "&type=Images";
            } else {
                lfmUrl = lfmUrl + "&type=Files";
            }

            tinymce.activeEditor.windowManager.openUrl({
                url: lfmUrl,
                title: 'File Manager',
                width: x * 0.8,
                height: y * 0.8,
                resizable: 'yes',
                close_previous: 'no',
                onMessage: (api, message) => {
                    const url = new URL(message.content);
                    const pathname = url.pathname;
                    callback(pathname);
                }
            });
        },
        setup: function (editor) {
            const textarea = document.querySelector(`#${editor.id}`);
            const textareaId = textarea.getAttribute('tinymce-textarea-id');

            editor.on('change', function () {
                editor.save();
                Livewire.dispatch('tinymce-textarea', { 'value': editor.getContent(), 'textareaId': textareaId });
            });
        }
    });
}

export { tinymceTextarea };