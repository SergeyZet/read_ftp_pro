window.onload = function () {


    // document.getElementById("status_login").onclick = function () {
    //     if(document.getElementById("status_login").checked){
    //         document.getElementById("status_login").checked = false;
    //     }
    // };

    document.getElementById("button_email").onclick = function () {
        //console.log(document.getElementById("name_email").value);
        let name = document.getElementById("name_email").value;
        let phone = document.getElementById("phone_email").value;
        let email = document.getElementById("e-mail_email").value;
        let coment = document.getElementById("coment_email").value;
        //console.log(name + " " + phone + " " + email + " " + coment);
        $.ajax({
            type: "POST",
            url: "main/server/endpoint/get_AJAX/emailto.php",
            data: {name: name, phone: phone,email:email,coment:coment}
        }).done(function (result) {
            /*
            if(result){
                alert("Сообщение успешно отправленно!");
            }
            else {
                alert("Ошибка  сообщение не отправленно отправленно!");
            }
            */
            alert("Сообщение успешно отправленно!");
            //console.log(result);
        });
    };

    document.getElementById("button_register").onclick = function () {
        let status = (document.getElementById("student").checked)?"student":"teacher";
        console.log("work");
        let name = document.getElementById("user-name").value;
        let surname = document.getElementById("user-surname").value;
        let email = document.getElementById("e-mail_register").value;
        let password = document.getElementById("password").value;
        let password2 = document.getElementById("password2").value;
        if(password!==password2){
            alert("Пароли не совпдают");
            console.log("Пароли не совпдают");
        }
        console.log("name = " + name + " surname = " +surname +" email = " + email  + "password = " + password);
        $.ajax({
            type: "POST",
            url: "main/server/endpoint/get_AJAX/users/registration.php",
            data: {status:status,name:name,surname:surname, email: email,password:password}
        }).done(function (result) {

        });
        console.log("name = " + name + " surname = " +surname +" email = " + email  + "password = " + password);
    };

    document.getElementById("login").onclick = function () {
        let login = document.getElementById("e-mail_login").value;
        let password = document.getElementById("password_login").value;
        $.ajax({
            type: "POST",
            //url: "main/server/endpoint/get_AJAX/users/registration.php",
            data: {login:login,password:password}
        }).done(function (result) {

        });
    };

    document.getElementById("close_register").onclick = function () {
        document.getElementById("overlay_register").classList.remove("show");
        document.getElementById("modal-form_register").classList.remove("show");
    };
    document.getElementById("user_register").onclick = function () {
        document.getElementById("overlay_register").classList.add("show");
        document.getElementById("modal-form_register").classList.add("show");
    };

    document.getElementById("close_login").onclick = function () {
        document.getElementById("overlay_login").classList.remove("show");
        document.getElementById("modal-form_login").classList.remove("show");
    };
    document.getElementById("user_login").onclick = function () {
        document.getElementById("overlay_login").classList.add("show");
        document.getElementById("modal-form_login").classList.add("show");
    };
};
