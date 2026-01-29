<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
        #login {
            width: 100%;
            padding: 50px 0;
            background-color: lightblue;
            margin-top: 20px;
            background-color: white;
            width: 400px;
            padding: 30px;
            margin: 50px auto;
        }
        #register {
            width: 100%;
            padding: 50px 0;
            background-color: lightblue;
            margin-top: 20px;
            background-color: white;
            width: 400px;
            padding: 30px;
            margin: 50px auto;
            display: none;
        }
        body{
            font-family: Arial, Helvetica, sans-serif;
            font-size: 16px;
            box-sizing: border-box;
        }

        #forms{
            background-color: white;
            width: 400px;
            padding: 30px;
            margin: 50px auto;
        }

        input{
            width: 94%;
            padding: 8px;
            margin-bottom: 15px;
        }

        button{
        width: 49%;
        padding: 10px;
        background-color: #007BFF;
        color: white;
        border: none;
        cursor: pointer
        }

        button:hover{
            background-color: #0056b3;
        }
        select {
            width: 395px;
            padding: 8px;
        }

</style>
</head>
<body>
<div id="login">

    <center><h1>Welcome Back!!</h1></center>


    <label>Student ID:</label>
    <input type="text" id="fname">
    <label>Password:</label>
    <input type="password" id="mname">


        <button type="submit">Login</button>
        <button onclick="myFunction()">Register</button>
    
        <p id="forgot" onclick="forgotpass()">Forgot Password?</p>


    </form>

</div>
<div id="register">
    
    <center><h1>Register</h1></center>
    <form onsubmit="return validateForm()">

    <label>Student ID:</label>
    <input type="text" id="studentid">
    <label>Full Name:</label>
    <input type="text" id="fname">
    <label>Age:</label>
    <input type="age" id="age">
    <label>Email Address:</label>
    <input type="email" id="email">
    <label>Password:</label>
    <input type="password" id="pass">
    <label>College:<br></label>
    <select>
        <option>College of Computer Studies</option>
        <option>Computer Science</option>
        <option>Business Administration</option>
</select>
<br><br>

    <label>Course:</label>
    <select>
        <option>Computer Science</option>
        <option>Business Administration</option>
        <option>Nursing</option>
</select><br><br>

        <button type="submit">Submit</button>

        <button onclick="myFunction1()">Login Balik</button>
        

    </form>

</div>

<script>
function myFunction(){
    document.getElementById("login").style.display = "none";
    document.getElementById("register").style.display = "block";
}

function myFunction1(){
    document.getElementById("register").style.display = "none";
    document.getElementById("login").style.display = "block";
}

function validateForm() {
    let studentid = document.getElementById("studentid").value;
    let fname = document.getElementById("fname").value;
    let age = document.getElementById("age").value;
    let email = document.getElementById("email").value;
    let pass = document.getElementById("pass").value;

    if (studentid === "" || fname === "" || age === "" || email === "" || pass === "") {
        alert("All fields are required!");
        return false;
    } 
    else {
        alert("Registration successful!");
        document.getElementById("register").style.display = "none";
        document.getElementById("login").style.display = "block";

    }
}
</script>

</body>
</html>

