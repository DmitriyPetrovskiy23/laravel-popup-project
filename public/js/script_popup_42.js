var main = document.body;
            main.innerHTML += `<div class="modal fade" id="popup_view" tabindex="-1" role="dialog" aria-labelledby="popup_view" aria-hidden="true"><div class="modal-dialog modal-dialog-centered" role="document"><div class="modal-content"><div class="modal-header"><h5 class="modal-title" id="exampleModalLongTitle">1233123</h5><button type="button" class="close close-popup" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div><div class="modal-body">123123</div><div class="modal-footer"><button type="button" class="btn btn-secondary close-popup" data-dismiss="modal">Close</button></div></div></div></div>`;
            let styleBootstrap = document.createElement('link');
            styleBootstrap.rel = 'stylesheet';
            styleBootstrap.href = 'http://example-app/css/bootstrap.min.css?v=1';
            document.head.appendChild(styleBootstrap);
            const xml = new XMLHttpRequest();
            const link ='http://example-app/popupadmin/change/42' ;
            xml.open('GET', link);
            xml.setRequestHeader('Content-Type', 'application/x-www-form-url');
            xml.addEventListener('readystatechange', () => {
                if (xml.readyState === 4 && xml.status === 200) {
                    setTimeout(()=>{
                        const change = xml.responseText;
                        if(Number(change) == 1){
                            const xttp = new XMLHttpRequest();
                            const url ='http://example-app/popupadmin/view_add/42?view=1';
                            const closePopup = document.querySelectorAll('.close-popup');
        
                            xttp.open('POST', url, true);
                            xttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                            xttp.addEventListener('readystatechange', () => {
                                if(xttp.readyState === 4 && xttp.status === 200) {       
                                    console.log('POST запрос выполнен');
                                }
                            });
                            xttp.send();
        
                        
                                const popupModal = document.getElementById('popup_view');
                                popupModal.classList.remove('fade');
                                popupModal.style = 'display:block;background-color: rgb(128 128 128 / 40%);';
                            
                                
                            for(let i = 0; i < closePopup.length; i++){
                                closePopup[i].addEventListener('click',() => {
                                    popupModal.classList.add('fade');
                                    popupModal.style = 'display:none';
                                });
                            }
                        }
                    },'10000');
                }
            });
            xml.send();