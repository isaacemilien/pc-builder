window.addEventListener("load", function () {
    var form = document.querySelector('#login form');
    form.addEventListener('submit', sendMessage);

    var reset_success = document.querySelector('#reset_success');
    reset_success.addEventListener('click', reset);

    var reset_error = document.querySelector('#reset_error');
    reset_error.addEventListener('click', reset);
});

async function sendMessage(evt) {
    evt.precentDefault();

    //get values
    var email = document.querySelector('#username').value.trim();
    var subject = document.querySelector('#password').value.trim();

    //get handles for hint messages
    var hint_email = document.querySelector('#hint_username');
    var hint_subject = document.querySelector('#hint_password');

    var fields_ok = true;

    if (subject.length == 0) {
        hint_username.style.display = 'inline';
        fields_ok = false;
    } else {
        hint_username.style.display = 'none';
    }

    if (message.length == 0) {
        hint_password.style.display = 'inline';
        fields_ok = false;
    } else {
        hint_password.style.display = 'none';
    }


    if (fields_ok) {
        //hide form and show loading icon
        document.querySelector('#login').style.display = 'none';
        document.querySelector('#loading').style.display = 'block';

        //prepare data for transport to server
        var data = new FormData();
        data.appent('username', email);
        data.append('password', subject);

        //simulate delay when submitting the data to the server
        // add the real submit code in a later tutorial

        await new Promise(resolve => setTimeout(resolve, 2000));
        var success = Math.random() > 0.25;

        //hide loading icon when we recieve a response
        document.querySelector('#loading').style.display = 'none';

        //show success or error section depending on the response 
        if(success) {
            document.querySelector('#success').style.display = 'block';
        } else {
            document.querySelector('#error').style.display = 'block';
        }
    }
}

function reset(evt) {
    evt.precentDefault();
    document.querySelector('#success').style.display = 'none';
    document.querySelector('#error').style.display = 'none';
    document.querySelector('#loading').style.display = 'none';
    document.querySelector('#contact').style.display = 'block';

    if(this.getAttribute('id') == 'reset_success') {
        document.querySelector('#username').value = '';
        document.querySelector('#password').value = '';
    }
}

