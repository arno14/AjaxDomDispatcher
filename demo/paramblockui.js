$.blockUI.defaults = { 
    // message displayed when blocking (use null for no message) 
    message:  'Please wait...', 
 
    // styles for the message when blocking; if you wish to disable 
    // these and use an external stylesheet then do this in your code: 
    // $.blockUI.defaults.css = {}; 
    css: { 
        color:          'red', 
        backgroundColor:'white'
    }, 
 
    // styles for the overlay 
    overlayCSS:  { 
        backgroundColor: 'black',
        opacity: 0.5,
        border: '1px solid black'
    }, 
 
    
     

 
    // z-index for the blocking overlay 
    baseZ: 1000, 
 
    // set these to true to have the message automatically centered 
    centerX: true, // <-- only effects element blocking (page block controlled via css above) 
    centerY: true, 
 

 

 

 
    // fadeIn time in millis; set to 0 to disable fadeIn on block 
    fadeIn:  200, 
 
    // fadeOut time in millis; set to 0 to disable fadeOut on unblock 
    fadeOut:  400, 
 
    // time in millis to wait before auto-unblocking; set to 0 to disable auto-unblock 
    timeout: 0, 
 
    // disable if you don't want to show the overlay 
    showOverlay: true
 

 

}; 