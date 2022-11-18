(function(){
    if (window.popupUrl !== undefined && window.popupUrl !== null && window.popupUrl !== '') {

        var body = document.querySelector("body");

        var popupOverlay = document.createElement('div');
        popupOverlay.addClass('popup-overlay');

        var popupContent = document.createElement('div');
        popupContent.addClass('popup-content');

        var popupContentInner = document.createElement('div');
        popupContentInner.addClass('inner');

        var closeButton = document.createElement('button');
        closeButton.addClass('close-button');
        closeButton.innerText = 'Close';

        var imgTag = document.createElement('img');
        imgTag.src = window.popupUrl;

        console.log(window.popupLink);

        if (window.popupLink !== undefined && window.popupLink !== null && window.popupLink !== '')
        {
            var link = document.createElement('a');
            link.href = window.popupLink;
            link.target = "_blank";
            link.appendChild(imgTag);
            imgTag = link;
        }

        popupContentInner.appendChild(closeButton);
        popupContentInner.appendChild(imgTag);
        popupContent.appendChild(popupContentInner);
        popupOverlay.appendChild(popupContent);

        body.appendChild(popupOverlay);

        closeButton.addEventListener('click',closePopUp);
        popupOverlay.addEventListener('click',closePopUp);

        setTimeout(function(){
            var shown = dsCookies.getCookie('dsPopupHasBeenShown');

            if(shown !== window.popupUrl)
            {
                popupOverlay.addClass('visible');
                dsCookies.setCookie('dsPopupHasBeenShown', window.popupUrl, 30);
            }
        },800);

        function closePopUp()
        {
            if(popupOverlay.classList.contains("visible"))
            {
                popupOverlay.classList.remove("visible");
            }
        }
    }
})();