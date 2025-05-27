document.addEventListener("DOMContentLoaded", function(t) {
	bricksIsFrontend && buUnfold();
});

function buUnfold() {
    
    const unfolds = bricksQuerySelectorAll(document, '.brxe-wpvbu-unfold');
    unfolds.forEach((element) => {        
        const id = element.getAttribute('id');
        const morebtn = element.querySelectorAll(".bultr-uf-btn-show");
        const lessbtn = element.querySelectorAll(".bultr-uf-btn-hide");
        const content = element.querySelector(".bultr-uf-content-wrap");
        const fixedheight = content.offsetHeight;

        
        morebtn.forEach(function (button){
            button.addEventListener('click', function(){
                contentWrap = element.querySelector('[data-ufid]');
                const fheight = contentWrap.scrollHeight;
                contentWrap.classList.add('bultr-uf-open');
                contentWrap.classList.remove('bultr-uf-close');
                contentWrap.style.height = fheight + "px";
            })
        })

        lessbtn.forEach(function (button){
            button.addEventListener('click', function(){
                let buttonId = this.getAttribute('data-id');
                contentWrap = element.querySelector(`[data-ufid=${buttonId}]`);
                contentWrap.classList.remove('bultr-uf-open');
                contentWrap.classList.add('bultr-uf-close');
                contentWrap.style.height = fixedheight + "px";
            })
        })
       
    })
}

