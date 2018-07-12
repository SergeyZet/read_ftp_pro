window.onload = function () {
    document.getElementById("button_email").onclick = function () {
        let data = {};
        data.name = document.getElementById("name_email").value;
        data.phone = document.getElementById("phone_email").value;
        data.email = document.getElementById("e-mail_email").value;
        data.coment = document.getElementById("coment_email").value;
        //console.log(data);
        $.ajax({
            type: "POST",
            //url: "main/server/endpoint/get_AJAX/email.php",
            url: "src/main/ajax/email.php",
            data:  {json: JSON.stringify(data)},
        }).done(function (result) {
            alert("Сообщение успешно отправленно!");
            console.log(result);
        });
    };

    document.getElementById("button_register").onclick = function () {
        let data = {};
        data.status = (document.getElementById("student").checked) ? "student" : "teacher";
        data.name = document.getElementById("user-name").value;
        data.surname = document.getElementById("user-surname").value;
        data.email = document.getElementById("e-mail_register").value;
        data.password = document.getElementById("password").value;
        data.password2 = document.getElementById("password2").value;
        // if (password !== password2) {
        //     alert("Пароли не совпдают");
        //     console.log("Пароли не совпдают");
        // }
        console.log(data.json);
        console.log(data);
        //console.log("name = " + name + " surname = " + surname + " email = " + email + "password = " + password);
        $.ajax({
            type: "POST",
            //url: "main/server/endpoint/get_AJAX/users/registration.php",
            url: "src/main/ajax/user/registration.php",
            data: {json: JSON.stringify(data)},
        }).done(function (result) {
            console.log(result);
        });

    };

    document.getElementById("login").onclick = function () {
        let data = {};
        data.login = document.getElementById("e-mail_login").value;
        data.password = document.getElementById("password_login").value;
        $.ajax({
            type: "POST",
            //url: "main/server/endpoint/get_AJAX/users/login.php",
            url: "src/main/ajax/user/login.php",
            data: {json: JSON.stringify(data)},
        }).done(function (result) {
            console.log(result);
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
