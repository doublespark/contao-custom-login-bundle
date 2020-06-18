(function(){

    var hiddenMessages = dsCookies.getCookie('customLoginHiddenMessages');

    if(!hiddenMessages)
    {
        hiddenMessages = [];
    }
    else
    {
        hiddenMessages = JSON.parse(hiddenMessages);

        if(hiddenMessages.length > 0)
        {
            for (var i = 0; i < hiddenMessages.length; i++) {
                document.getElementById('message-'+hiddenMessages[i]).style.display = 'none';
            }
        }
    }

    var dismissButtons = document.querySelectorAll(".message .close-button");

    for (var i = 0; i < dismissButtons.length; i++) {
        dismissButtons[i].addEventListener('click',onDismissButtonClick,false);
    }

    function onDismissButtonClick(e)
    {
        e.preventDefault();
        e.target.parentElement.style.display = 'none';
        hiddenMessages.push(e.target.parentElement.attributes['data-mid'].value);
        dsCookies.setCookie('customLoginHiddenMessages', JSON.stringify(hiddenMessages), 900);
    }

})();