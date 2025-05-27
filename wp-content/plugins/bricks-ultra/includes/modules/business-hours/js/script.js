document.addEventListener("DOMContentLoaded", function(t) {
	bricksIsFrontend && buBusinessHours();
});
function buBusinessHours() {
    const businessH = bricksQuerySelectorAll(document, '.brxe-wpvbu-business-hours');
    businessH.forEach(element => {
    
        const timezone = element.getAttribute('data-timezone');
        const time = element.getAttribute('data-time');
        let timeFormat = element.getAttribute('data-format');
        timeFormat = timeFormat == "true" ? true : false;
        let settings = JSON.parse(element.getAttribute('data-settings'));
        //formating string from calcTime to time in string(12:00)
        const options = {
            hour : "numeric",
            minute : "numeric",
            second: "numeric",
            hour12: timeFormat, 
        }
        if(settings.businessIndicator == true)
        {
            calcTime(timezone);
            setInterval(calcTime, 1000,timezone); // Repeat myFunction every 1 mintb b bb
            get_Time_Left();
            setInterval(get_Time_Left,1000);
        }
        
        //function to get time by the given timezone
        function calcTime(timezone){
            const date = new Date();
            let offset;
            let regexp = /^(\+|\-)\d{1,2}:\d{2}$/;
            if(regexp.test(timezone)){
                const [hours,mints] = timezone.split(":").map(Number);
                offset = ((hours * 60) + mints)*60;
            }
            else{
                const tz= Intl.DateTimeFormat(undefined,{timeZone : timezone}).resolvedOptions().timeZone;
                if(tz === timezone){ 
                    let dt = new Date();
                    dt = dt.toLocaleString("en-US",{timeZone: timezone});
                    date.setTime(Date.parse(dt));
                    var datedisplay = date;
                    glbCurrenttime = date.getTime();
                    const biTimehtml = element.querySelector('.bultr-bh-bi-Time');
                    biTimehtml.innerHTML= datedisplay.toLocaleString('en-US',options);
                }
            }
            if(offset >= 0 || offset <= 0){
                
                // 1000 milliseconds = 1 second
                // 1 minute = 60 seconds 
                // 1 hour = 60 mints
                // 1 hour = 3600
                // converting minutes to milliseconds  60 * 1000 = 60000.
                // converting hours to millisecond 3600 * 1000 = 3600000.
                const utcTime = date.getTime() + (date.getTimezoneOffset() * 60000);
                date.setTime(utcTime + (offset * 1000));
                var datedisplay = date;
                let dateMatch = new Date();
                const matchTime = dateMatch.getTime() + (offset * 1000);
                dateMatch.setTime(matchTime);
                glbCurrenttime = Math.ceil(dateMatch.getTime()/1000);
            }
            const biTimehtml = element.querySelector('.bultr-bh-bi-Time');
            if(biTimehtml != undefined){
                biTimehtml.innerHTML = datedisplay.toLocaleString('en-US',options);
            }
            
        }   
        
        function get_Time_Left(){
            //get warning mst element
            incicatorLeft = element.querySelector('.bultr-bh-bi-left');
            openWrn = element.querySelector('.bultr-bh-bi-open-wmsg');
            closeWrn = element.querySelector('.bultr-bh-bi-close-wmsg');
            //get current day wrapper
            const cday_wrap = element.querySelector('.bultr-currentday');
            if(cday_wrap != undefined)
            {
                    //getting all slots in current day wrap
                const slots = cday_wrap.querySelectorAll('.bultr-bh-label-wrap');
            
                //LABEL checking if current time is btw slot if true then open else close
                const slot = Object.values(slots);
                for (const ele of slot) {
                    const Opentime  = parseInt(ele.getAttribute('data-open'));
                    const Closetime = parseInt(ele.getAttribute('data-close'));
                    if(settings.indctLabel == true){
                        incicatorLabel = element.querySelector('.bultr-labelss');
                        if(incicatorLabel){
                            if(glbCurrenttime > Opentime && glbCurrenttime < Closetime){
                                incicatorLabel.innerHTML = settings.openLableTxt;
                                incicatorLabel.classList.add('bultr-lbl-open');
                                incicatorLabel.classList.remove('bultr-lbl-close'); 
                                break;
                            }
                            else{
                                incicatorLabel.innerHTML = settings.closeLabelTxt;
                                incicatorLabel.classList.add('bultr-lbl-close');
                                incicatorLabel.classList.remove('bultr-lbl-open');

                            }
                        }
                    }
                }
                //WARNING MASSAGE
                
                for(const ele of slot){
                    const Opentime  = parseInt(ele.getAttribute('data-open'));
                    const Closetime = parseInt(ele.getAttribute('data-close'));
                    openWrn = element.querySelector('.bultr-bh-bi-open-wmsg');
                    closeWrn = element.querySelector('.bultr-bh-bi-close-wmsg');
                    //opening warning
                    if(Opentime > glbCurrenttime){
                        
                        openmints = Math.ceil((Opentime - glbCurrenttime)/60);
                        
                        if(openmints <= parseInt(settings.openMints)){
                            if(settings.openWrnMsg == true){
                                if(openWrn){
                                    openWrn.innerHTML = settings.openWrnMsgTxt + " " + openmints + " Minutes";
                                }
                                else{
                                        openWrn = document.createElement('div');
                                        openWrn.setAttribute('class', 'bultr-bh-bi-open-wmsg');
                                        incicatorLeft.appendChild(openWrn);
                                        openWrn.innerHTML = settings.openWrnMsgTxt + " " + openmints + " Minutes";
                                }
                            }        
                        }
                    break;
                    }
                    else{
                        if(openWrn){
                            openWrn.innerHTML = "";
                        }
                    }
                    //closing warning
                    if(glbCurrenttime < Closetime || glbCurrenttime > Opentime){
                        
                        closemints = Math.ceil((Closetime - glbCurrenttime)/60);

                        setCloseMint =  parseInt(settings.closeMints);
                        if(closemints <= setCloseMint && closemints != 'NaN'){

                            if(closemints > 0){
                                if(settings.closeWrnMsg == true){
                                    if(closeWrn){
                                        closeWrn.innerHTML = settings.closeWrnMsgText + " " + closemints + " Minutes";
                                    }
                                    else{
                                        closeWrn = document.createElement('div');
                                        closeWrn.setAttribute('class', 'bultr-bh-bi-close-wmsg');
                                        incicatorLeft.appendChild(closeWrn);
                                        closeWrn.innerHTML = settings.closeWrnMsgText + " " + closemints + " Minutes";
                                    }
                                    closeWrn.innerHTML = settings.closeWrnMsgText + " " + closemints + " Minutes";
                                } 
                            }
                            else{
                                if(closeWrn){
                                    closeWrn.innerHTML = "";
                                }
                            } 
                        }
                    }
                }
            }
            
        }
    });
}