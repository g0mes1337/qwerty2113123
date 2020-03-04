function request(target, body, callback) {
    const request = new XMLHttpRequest();
    request.open("POST", "/" + target, true);
    request.setRequestHeader('Content-Type', 'application/json; charset=UTF-8');
    request.onreadystatechange = function () {
        if (request.readyState === XMLHttpRequest.DONE) {
            callback(request.status, request.responseText);
        }
    };
    request.send(JSON.stringify(body));
}

function SignUp(form) {
    request('application/action/signUp.php',
        {
            ['mail']: form.mail.value,
            ['password']: form.password.value
        }, function (status, responseText) {
            if (status === 200) {
                // window.location.href = '/';
            } else {
                console.log(responseText);
                alert(JSON.parse(responseText)['issueMessage']);
            }
        })
}

function LogIn(form) {
    request('application/action/logIn.php',
        {
            ['mail']: form.mail_confirm.value,
            ['password']: form.password_confirm.value
        }, function (status, responseText) {
            if (status === 200) {
                // window.location.href = '/';
            } else {
                console.log(responseText);
                alert(JSON.parse(responseText)['issueMessage']);
            }
        })
}


function addCourses(form) {
    request('application/action/addCourses.php',
        {
            ['title']: form.title.value,
            ['description']: form.description.value,
            ['date_courses']:form.date_courses.value,
            ['price']:form.price.value
        }, function (status, responseText) {
            if (status === 200) {
                // window.location.href = '/';
            } else {
                console.log(responseText);
                alert(JSON.parse(responseText)['issueMessage']);
            }
        })
}
