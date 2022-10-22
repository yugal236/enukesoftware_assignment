(function() {
    'use strict';
    const el = new Image();
    let consoleIsOpen = false;
    let consoleOpened = false;

    Object.defineProperty(el, 'id', {
        get: () => {
            consoleIsOpen = true;
        }
    });

    const verify = () => {
        //console.dir(el);
        console.log(consoleIsOpen);
        if (consoleIsOpen === false && consoleOpened === true) {
            // console closed
            window.dispatchEvent(new Event('devtools-opened'));
            consoleOpened = false;
        } else if (consoleIsOpen === true && consoleOpened === false) {
            // console opened
            window.dispatchEvent(new Event('devtools-closed'));
            consoleOpened = true;
        }
        consoleIsOpen = false;
        setTimeout(verify, 1000);

    }

    verify();
})();

// Use like this
// window.addEventListener('devtools-opened', ()=>{});
// window.addEventListener('devtools-closed', ()=>{});