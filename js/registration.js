var First_Name = "";
var Last_Name = "";
var Enrollment_No = "";
var GR_No = "";
var Mobile_No = "";
var Institute_Mail_ID = "";
var Secondary_Mail_ID = "";
var Department = "";
var Program = "";
var Semester = "";
var Password = "";
var Confirm_Password = "";

document.addEventListener("DOMContentLoaded" , function(event) {
    event.preventDefault();

    document.getElementById("First_Name").addEventListener("change", function() {
        First_Name = this.value.trim();
    });

    document.getElementById("Last_Name").addEventListener("change", function() {
        Last_Name = this.value.trim();
    });

    document.getElementById("Enrollment_No").addEventListener("change", function() {
        Enrollment_No = this.value.trim();
    });

    document.getElementById("GR_No").addEventListener("change", function() {
        GR_No = this.value.trim();
    });

    document.getElementById("Mobile_No").addEventListener("change", function() {
        Mobile_No = this.value.trim();
    });

    document.getElementById("Institute_Mail_ID").addEventListener("change", function() {
        Institute_Mail_ID = this.value.trim();
    });

    document.getElementById("Secondary_Mail_ID").addEventListener("change", function() {
        Secondary_Mail_ID = this.value.trim();
    });

    document.getElementById("Department").addEventListener("change", function() {
        Department = this.value;
    });

    document.getElementById("Program").addEventListener("change", function() {
        Program = this.value;
    });

    document.getElementById("Semester").addEventListener("change", function() {
        Semester = this.value;
    });

    document.getElementById("Password").addEventListener("change", function() {
        Password = this.value.trim();
    });

    document.getElementById("Confirm_Password").addEventListener("change", function() {
        Confirm_Password = this.value.trim();
    });

    document.getElementById("registerBtn").addEventListener("click", function() {
        Validate_Form();
    });

    function Validate_Form() {

        console.log("Register button pressed!");
        console.log("First_Name = ", this.First_Name);
        console.log("Last_Name = ", this.Last_Name);
        console.log("Enrollment_No = ", this.Enrollment_No);
        console.log("GR_No = ", this.GR_No);
        console.log("Mobile_No = ", this.Mobile_No);
        console.log("Institute_Mail_ID = ", this.Institute_Mail_ID);
        console.log("Secondary_Mail_ID = ", this.Secondary_Mail_ID);
        console.log("Department = ", this.Department);   
        console.log("Program = ", this.Program);
        console.log("Semester = ", this.Semester);
        console.log("Password = ", this.Password);
        console.log("Confirm_Password = ", this.Confirm_Password);

        var fname = true;
        var lname = true;
        var enrollment_no = true;
        var grno = true;
        var mobileno = true;
        var instituteid = true;
        var secondaryid = true;
        var password = true;
        var confirmpassword = true;
        
        var nameRegex = /^[a-zA-Z]+$/;
        var enrollmentRegex = /^\d{11}$/;
        var grNoRegex = /^\d{6}$/;
        var mobileRegex = /^\d{10}$/;
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        var passwordRegex = /^\S{8,}$/;

        if (!this.First_Name.match(nameRegex)) {
            alert('First Name should only contain alphabets');
            fname = false;
        }

        if (!this.Last_Name.match(nameRegex)) {
            alert('Last Name should only contain alphabets');
            lname = false;
        }

        if (this.First_Name === this.Last_Name) {
            alert('First Name and Last Name should not be the same');
        }

        if (!this.Enrollment_No.match(enrollmentRegex)) {
            alert('Enrollment No should only contain 11 digits');
            enrollment_no = false;
        }

        if (!this.GR_No.match(grNoRegex)) {
            alert('GR No should only contain 6 digits');
            grno = false;
        }

        if (!this.Mobile_No.match(mobileRegex)) {
            alert('Mobile No should only contain 10 digits');
            mobileno = false;
        }

        if (this.Institute_Mail_ID !== this.First_Name.toLowerCase() + "." + this.Last_Name.toLowerCase() + this.GR_No + "@marwadiuniversity.ac.in") {
            alert('Institute Mail ID is not valid');
            instituteid = false;
        }

        if (!this.Secondary_Mail_ID.match(emailRegex)) {
            alert('Secondary Mail ID is not valid');
            secondaryid = false;
        }

        if (!this.Password.match(passwordRegex)) {
            alert('Password should contain at least 8 characters');
            password = false;
        }

        if (this.Password !== this.Confirm_Password) {
            alert('Password and Confirm Password should match');
            confirmpassword = false;
        }

        var result = fname && lname && !(this.First_Name === this.Last_Name) && enrollment_no && grno && mobileno && instituteid && secondaryid && password && confirmpassword ;
        return result;
    }

    var form = document.getElementById("Registration_Form");
    function submitForm() {
        if (Validate_Form()) {
            var formData = new FormData(form);
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "../includes/signup.inc.php", true);
            xhr.onload = function() {
    if (xhr.status == 200) {
        var response = JSON.parse(xhr.responseText);
        if (response.success) {
            window.location.href = response.redirect_url;
        } else {
            console.log("Registration failed:", response.errors);
        }
    }
};

            
            xhr.send(formData);
        }
    }

    form.addEventListener("submit", function(event) {
        event.preventDefault();
        submitForm();
    });
});