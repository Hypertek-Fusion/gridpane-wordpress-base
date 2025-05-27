
window.onload = function () {

    // Icon picker
    if(typeof IconPicker === 'function'){

        const iconPickerInputs = document.getElementsByClassName("acpt-iconpicker");

        if(iconPickerInputs.length > 0) {
            for (let i = 0; i < iconPickerInputs.length; i++) {

                const target = iconPickerInputs.item(i).dataset.target;
                const iconPickerInput = new IconPicker(iconPickerInputs.item(i), {
                    theme: 'bootstrap-5',
                    iconSource: [
                        'Iconoir',
                        'FontAwesome Solid 6',
                    ],
                    closeOnSelect: true
                });

                const iconElementInput = document.getElementById(target+"_target");
                const iconElementValue = document.getElementById(target+"_svg");

                iconPickerInput.on('select', (icon) => {

                    if (iconElementInput.innerHTML !== '') {
                        iconElementInput.innerHTML = '';
                    }

                    iconElementInput.className = `acpt-selected-icon ${icon.name}`;
                    iconElementInput.innerHTML = icon.svg;
                    iconElementValue.value = icon.svg;
                });
            }
        }
    }

    // CodeMirror
    if(typeof CodeMirror === 'function'){
        const codeMirrors = document.getElementsByClassName("acpt-codemirror");

        if(codeMirrors.length > 0){
            for (let i = 0; i < codeMirrors.length; i++) {
                CodeMirror.fromTextArea(codeMirrors.item(i), {
                    indentUnit: 2,
                    tabSize: 2,
                    mode: 'htmlmixed',
                    lineNumbers: true
                })
            }
        }
    }

    // Quill
    if(typeof Quill === 'function'){
        const quills = document.getElementsByClassName("acpt-quill");

        if(quills.length > 0){
            for (let i = 0; i < quills.length; i++) {
                const quill = new Quill(`#${quills.item(i).id}`, {
                    modules: {
                        toolbar: [
                            ['bold', 'italic'],
                            ['link', 'blockquote', 'code-block', 'image'],
                            [{ list: 'ordered' }, { list: 'bullet' }],
                        ],
                    },
                    theme: 'snow'
                });

                // update editor
                quill.on('text-change', function(delta, oldDelta, source) {
                    const value = quill.container.firstChild.innerHTML;
                    const input  = document.getElementById(`${quills.item(i).id}_hidden`);

                    if(input){
                        input.value = value;
                    }
                });
            }
        }
    }
};
