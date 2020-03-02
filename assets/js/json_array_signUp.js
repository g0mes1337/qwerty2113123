function request(form) {
    let request = new XMLHttpRequest();
    let json = ({
        email: form.login.value,
        password: form.password.value
    });

    request.open('POST',"http://qwerty2113123-master/");
    request.responseType = 'json';
    request.send();
    request.onreadystatechange = function () {
        if(request.readyState === XMLHttpRequest.DONE && request.status === 200) {
            let result=JSON.parse(request.responseText);
            console.log(result);
            alert(result);
        }
    };
}
