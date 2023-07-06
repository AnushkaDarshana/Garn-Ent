$(document).ready(function () {

    //-------------------------------------------------Employee Registration-------------------------------------------

    //refer the form fields 
    let e_nameField = $("#e_name");
    let e_nicField = $("#e_nic");
    let e_addressField = $("#e_address");
    let e_emailField = $("#e_email");
    let e_contactField = $("#e_contact");
    let e_soc_statusField = $("#e_soc_status");
    let e_user_typeField = $("#e_user_type");
    let empRoleInfo= $("#empRole");

    //error fields 
    let e_nameErrorField = $("#e_nameHelp");
    let e_nicErrorField = $("#e_nicHelp");
    let e_addressErrorField = $("#e_addressHelp");
    let e_emailErrorField = $("#e_emailHelp");
    let e_contactErrorField = $("#e_contactHelp");
    let e_soc_statusErrorField = $("#e_soc_statusHelp");
    let e_user_typeErrorField = $("#e_user_typeHelp");

    //fetch the employee role
    function getEmpRoleInfo()
    {
        let viewSup = 1;
        empRoleInfo.empty();
        empRoleInfo.append("<option>Loading......</option>");
        $.ajax({
            type: "POST",
            data:{viewSup},
            url: "../../controller/EmpRoleController.php",
            dataType: "json",
            success: function (data) {
                empRoleInfo.empty();
                empRoleInfo.append("<option value='0'> -- Select Suitable Role --");
                $.each(data, function (i) {
                    empRoleInfo.append('<option value="' + data[i].roleId + '">' + data[i].roleName +'</option>');
                });
            },
            complete: function () {
            }
        });

    }
    getEmpRoleInfo();
   
    $("#empRegistrationForm").submit(function (event) {

        //prevent default events when submitting the document 
        event.preventDefault();

        //get the fields values 
        let e_name = e_nameField.val();
        let e_nic = e_nicField.val();
        let e_address = e_addressField.val();
        let e_email = e_emailField.val();
        let e_contact = e_contactField.val();
        let e_soc_status = e_soc_statusField.val();
        let e_user_type =e_user_typeField.val();
        let empRole =  empRoleInfo.val();

        $.ajax({
            type: "POST",
            url: "../../controller/EmpDataValidator.php",
            data: {checkEmpRegFlag:1, e_name:e_name, e_nic:e_nic, e_address:e_address, e_email:e_email, e_contact:e_contact, e_soc_status:e_soc_status,e_user_type:e_user_type, empRole:empRole},
            success: function (response) {
                if(response.includes("invalid  name")){
                    e_nameErrorField.html("Invalid name");
                    e_nameField.addClass("errorField");
                }
                if(response.includes("invalid nic")){
                    e_nicErrorField.html("Invalid nic");
                    e_nicField.addClass("errorField");
                }
                if(response.includes("invalid address")){
                    e_addressErrorField.html("Invalid address");
                    e_addressField.addClass("errorField");
                }
                if(response.includes("invalid email")){
                    e_emailErrorField.html("Invalid email");
                    e_emailField.addClass("errorField");
                }
                if(response.includes("invalid contact")){
                    e_contactErrorField.html("Invalid contact");
                    e_contactField.addClass("errorField");
                }
                if(response.includes("invalid social status")){
                    e_soc_statusErrorField.html("Invalid social status");
                    e_soc_statusField.addClass("errorField");
                }
                    if(response.includes("invalid user type")){
                        e_user_typeErrorField.html("Invalid user type");
                        e_user_typeField.addClass("errorField");
                }
                if(response.includes("invalid Role")){
                    empRoleInfo.addClass("errorField");
                }
                if(response.includes("successfully added")){
                    $.confirm({
                        title: 'Employee Registered!',
                        content: 'The new password will be the NIC',
                        type: 'green',
                        typeAnimated: true,
                        buttons: {
                            close: function () {
                            }
                        }
                    });
                }
                if(response.includes("technicalError")){
                    $.confirm({
                        title: 'Technical error occurred',
                        content: 'Please contact the technical team',
                        type: 'red',
                        typeAnimated: true,
                        buttons: {
                            close: function () {
                            }
                        }
                    });
                }
            }           
        });

    });

    //function for remove errors or add errors click submit
    function addRemoveErrors(inputField,errorField)
    {
        inputField.keypress(function () {
            inputField.removeClass("errorField");
            errorField.removeClass("errorText").html("");
        });

        inputField.keypress(function () {
            inputField.keyup(function () {
                if (inputField.val()) {
                    inputField.removeClass("errorField");
                    errorField.removeClass("errorText").html("");
                    inputField.css("border-color","");
                } else {
                    inputField.addClass("errorField");
                    errorField.addClass("errorText").html("Please fill this field");
                }
            });
        });
    }

    addRemoveErrors(e_nameField, e_nameErrorField);
    addRemoveErrors(e_nicField, e_nicErrorField);
    addRemoveErrors(e_addressField, e_addressErrorField);
    addRemoveErrors(e_emailField, e_emailErrorField);
    addRemoveErrors(e_contactField, e_contactErrorField);
    addRemoveErrors(e_soc_statusField, e_soc_statusErrorField);
    addRemoveErrors(e_user_typeField, e_user_typeErrorField);

    //remove errors of the emp role field
    empRoleInfo.change(function (e) { 
       if($(this).val() > 0){
            $(this).removeClass("errorField");
       }
    });

    //clear button
    $("#empRegClearButton").on("click", function () {
        e_nameField.removeClass("errorField");
        e_nameErrorField.removeClass("errorText").html("");
        e_nicField.removeClass("errorField");
        e_nicErrorField.removeClass("errorText").html("");
        e_addressField.removeClass("errorField");
        e_addressErrorField.removeClass("errorText").html("");
        e_emailField.removeClass("errorField");
        e_emailErrorField.removeClass("errorText").html("");
        e_contactField.removeClass("errorField");
        e_contactErrorField.removeClass("errorText").html("");
        e_soc_statusField.removeClass("errorField");
        e_soc_statusErrorField.removeClass("errorText").html("");
        e_user_typeField.removeClass("errorField");
        e_user_typeErrorField.removeClass("errorText").html("");
        empRoleInfo.removeClass("errorField");
    });

    //-------------------------------------------------Employee Login-------------------------------------------

    let empLoginButton = $("#empLoginButton");

    let empLoginEmail = $("#empLoginEmail");
    let empLoginPassword = $("#empLoginPassword");

    empLoginButton.on("click",  function () { 
        let empLoginEmailVal = empLoginEmail.val();
        let empLoginPasswordVal = empLoginPassword.val();
        $.ajax({
            type: "POST",
            data:{empLoginCheck:1, empLoginEmailVal:empLoginEmailVal, empLoginPasswordVal:empLoginPasswordVal},
            url: "../../controller/EmpLoginController.php",
            success: function (response) {
                if(response.includes("wrongPassword")){
                    $.confirm({
                        title: 'Oops!',
                        content: 'Please check the password again',
                        type: 'red',
                        typeAnimated: true,
                        buttons: {
                            close: function () {
                            }
                        }
                    });
                }
                if(response.includes("wrongEmail")){
                    $.confirm({
                        title: 'Oops!',
                        content: 'Please check the email again',
                        type: 'red',
                        typeAnimated: true,
                        buttons: {
                            close: function () {
                            }
                        }
                    });
                }
                if(response.includes("systemError")){
                    $.confirm({
                        title: 'Technical error occurred ',
                        content: 'Please contact the developer',
                        type: 'red',
                        typeAnimated: true,
                        buttons: {
                            close: function () {
                            }
                        }
                    });
                }
                if(response.includes("admin")){
                    window.location.href = 'admin.php';
                }
                if(response.includes("manager")){
                    window.location.href = 'manager.php';
                }
            }
        });

     });

});

