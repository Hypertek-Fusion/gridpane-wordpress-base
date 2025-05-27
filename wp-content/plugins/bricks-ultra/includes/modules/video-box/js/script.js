document.addEventListener("DOMContentLoaded", function(t) {
	bricksIsFrontend && buVideoBox();
});
function buVideoBox() {
    const videobox = bricksQuerySelectorAll(document, '.brxe-wpvbu-video-box');
    videobox.forEach((wrapper) => {
        const id = wrapper.getAttribute('id');
        let videoType = wrapper.getAttribute('data-video-type-vb');
        contentWrap = wrapper.querySelector('.bultr-video-content');
        isLightbox = '';
        isAutoplay = '';
        isSticky = '';
        
        if(wrapper.hasAttribute("data-vb-lightbox")){
            isLightbox = wrapper.getAttribute('data-vb-lightbox');
        }
        if(wrapper.hasAttribute("data-vb-autoplay")){
            isAutoplay = wrapper.getAttribute('data-vb-autoplay');
        }
        if(contentWrap.hasAttribute('data-video-sticky-vb')){
            isSticky = contentWrap.getAttribute('data-video-sticky-vb');
        }

        //creating iframe if lightbox is not true
        if(isLightbox !== 'true'){
            if(bricksData.isAdmin != 1){
                wrapper.addEventListener('click', function(e){   
                    createIframes(this);
                 }) 
            }
        }
        
        //check autoplay
        if(isAutoplay == 'true'){
            var waypoint = new Waypoint({
                element: wrapper,
                handler: function(direction) {
                    if(direction == 'down'){
                        if(bricksData.isAdmin != 1){
                            createIframes(wrapper);
                        }
                    }
                },
                offset : 'bottom-in-view',
            });
        }

        if(isLightbox === 'true'){
            let wrap  = wrapper.querySelector('.bultr-video-play');
            var galleryId = wrap.getAttribute('data-vb-galleryid');
            if(galleryId == null || galleryId == ''){
                galleryId = '1';
            }
            let plugins = [
                lgVideo,
                lgHash,
            ];
            if(wrap.hasAttribute('data-vb-fullscreen') && wrap.getAttribute('data-vb-fullscreen') === 'true'){
                plugins.push(lgFullscreen);
            }
            if(wrap.hasAttribute('data-vb-share') && wrap.getAttribute('data-vb-share') === 'true'){
                plugins.push(lgShare);
            }
            let videoObject = {
                'selector': '.bultr-video-play',
                'plugins': plugins,
                'galleryId' : galleryId,
                'download': false,
                'counter' : false,
                videojs: true,
                videojsOptions: {
                    muted: true,
                },

            }
            if(videoType != 'hosted'){
                videoObject[`${videoType}PlayerParams`] = JSON.parse(wrap.getAttribute('data-params'));
            }
            else{
                videoObject['videojsOptions'] = JSON.parse(wrap.getAttribute('data-params'));

            }
            lightGallery(wrapper,videoObject);
        }
    
        //sticky settings
        if(isSticky === 'true'){
           
            stickyWrap = wrapper.querySelector('.bultr-video-sticky');
            if(bricksData.isAdmin == 1 ){
                if(stickyWrap.getAttribute('data-editor-sticky-preview') != 'true' ){
                    return;
                }
            }
            
            var bu_waypoint = new Waypoint({
                element: wrapper,
                handler: function(direction){
                    if(direction == 'down'){
                        stickyWrap.classList.remove('bultr-sticky-hide');
                        stickyWrap.classList.add('bultr-sticky-apply');
                    }
                    else{
                        stickyWrap.classList.add('bultr-sticky-hide');
                        stickyWrap.classList.remove('bultr-sticky-apply');
                        if(stickyWrap.classList.contains('bultr-sticky-hide')){
                            notSticky = wrapper.querySelector('.bultr-video-content');
                            notSticky.removeAttribute("style");
                        }
                    }
                    if(stickyWrap.hasAttribute('data-sticky-draggable')){
                        if(stickyWrap.getAttribute('data-sticky-draggable') === 'true'){
                            if(stickyWrap.classList.contains('bultr-sticky-apply')){
                                budraggableElement(wrapper);
                            }
                        }
                    }
                }
            });
            
            
            const closeBtn = contentWrap.querySelector('.bultr-vbsticky-close-btn');
            if(closeBtn != null){
                closeBtn.addEventListener('click',function(e){
                    e.stopPropagation();
                    stickyWrap.classList.add('bultr-sticky-hide');
                    stickyWrap.classList.remove('bultr-sticky-apply');
                });
            }
            
        }


        //creating iframes
        function createIframes(ele){
            let videoType = ele.getAttribute('data-video-type-vb');
            let playWrapper = ele.querySelector('.bultr-video-play');
            let url = '';
            if(videoType != 'hosted'){
                url = playWrapper.getAttribute('data-src-vb');
                let isIframe = ele.querySelector('iframe');
                if(isIframe == null){
    
                    var iframe =document.createElement('iframe');
                    iframe.classList.add('bultr-video-iframe');
                    iframe.setAttribute('src', url);
                    iframe.setAttribute('frameborder', '0');
                    iframe.setAttribute('allowfullscreen', '1');
                    iframe.setAttribute('allow', 'accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture');
                    playWrapper.innerHTML = '';
                    playWrapper.append(iframe);
                }
            }
            else{
                if(videoType == 'hosted')
                {   
                    
                    let videootag = wrapper.querySelector('.bultr-hosted-video');
                    if(videootag == null){
                        let hostedurl = wrapper.getAttribute('data-vbhosted-url');
                        let hostedParam = wrapper.getAttribute('data-vbhosted-param');
                        if(hostedParam.length > 0 ){
                            hostedParam = hostedParam.split(' ');
                        }
                        let hostedHtml = document.createElement('video');
                        hostedHtml.classList.add('bultr-hosted-video');
                        hostedHtml.setAttribute('src', hostedurl);
                        if(Array.isArray(hostedParam) && hostedParam.length > 0){
                            hostedParam.forEach(function(attribute) {
                                if(attribute !== 'nodownload'){
                                    hostedHtml.setAttribute(attribute, '');
                                }
                                else{
                                    hostedHtml.setAttribute('controlslist',attribute);
                                }
                            });
                        }
                        if(!hostedHtml.hasAttribute('autoplay')){
                            hostedHtml.setAttribute('autoplay', '');
                        }
                        playWrapper.innerHTML = '';
                        playWrapper.append(hostedHtml);
                        

                    }
                        
                }
            }
        }
        // draggable element
        function budraggableElement(ele){
            var pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0;
            ele.querySelector('.bultr-video-content').onmousedown = budragMouseDown;
            innerWrap = ele.querySelector('.bultr-video-content');
            function budragMouseDown(e){
                innerWrap.classList.add('bultr-draggable-ele');
                e = e || window.event;
                e.preventDefault();
                pos3 = e.clientX;
                pos4 = e.clientY;
                wrapper.onmouseup = bucloseDragElement;
                wrapper.onmousemove = buelementDrag;
            }
            function bucloseDragElement(e){
                wrapper.onmouseup = null;
                wrapper.onmousemove = null;
                innerWrap.classList.remove('bultr-draggable-ele');

            }
            function buelementDrag(e){
                e = e || window.event;
                e.preventDefault();
                pos1 = pos3 - e.clientX;
                pos2 = pos4 - e.clientY;
                pos3 = e.clientX;
                pos4 = e.clientY;
                innerWrap.style.top = (innerWrap.offsetTop - pos2) + 'px';
                innerWrap.style.left = (innerWrap.offsetLeft - pos1) + 'px';
            }
        }
    })


}