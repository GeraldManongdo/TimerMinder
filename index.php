<?php
include('backend/register.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--LINK FOR POPPINS FONT-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300;400;500;600;700&family=Noto+Sans:wdth,wght@62.5..100,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto+Condensed:wght@100..900&display=swap" rel="stylesheet">
    <!--LINK FOR BOX ICON-->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="asset/style.css">
    <!--YOU CAN PUT ANY LOGO-->
    <link rel="icon" type="image/png" href="/images/">
    <title>TimeMinder</title>
    <Style>
        body{
            overflow:hidden;
        }
        /*SIGN UP CONTAINER*/
        section.signUpContainer {
            margin: 0 auto;
            display: flex;
            width: 100vw;
            height: 100vh;
            background-color: #AF2213;

        }
        section.signUpContainer::after {
            content: "";
            position: fixed;
            background: rgb(250,246,246);
            background: linear-gradient(180deg, rgba(250,246,246,1) 10%, rgba(221,218,218,1) 79%);
            border: 2px solid black;
            width: 780px;
            height: 1300px;
            top: -100px;
            right: -40px;
            transform: rotate(35deg); /* Rotate by 56 degrees */
        }
        section.signUpContainer section.title,
        section.signUpContainer section.signUp{
            margin: auto;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 2;
        }
        section.signUpContainer section.title{
            font-size: 50px;
            color: #FFFFFF;
            line-height:35px;
            display:flex;
        }
        section.signUpContainer section.title .logo{
            font-size: 100px;
            margin-bottom:20px;
        }
        section.signUpContainer section.title p{
            font-size: 20px;
            top: -20px;
            font-weight: 300;
            letter-spacing: 4px;
            margin:0;
        }
        section.signUpContainer section.signUp input{
            margin: 15px;
            font-size: 15px;
            border: 2px solid black;
            border-radius: 30px;
            outline: none;
            padding: 10px 20px;
        }
        section.signUpContainer section.signUp h1.title{
            font-size: 35px;
            padding: 15px 20px 5px 20px;
            margin:0;
        }
        section.signUpContainer section.signUp button,
        section.signUpContainer section.signUp input[type="submit"]{
            background-color: #AF2213;
            width: 50%;
            margin: 15px auto;
            font-size: 18px;
            font-weight: 600;
            color: #FFFFFF;
            padding: 5px;
            border: 2px solid black;
            border-radius: 20px;
            cursor: pointer;
        }
        section.signUpContainer section.signUp span{
            margin: 10px auto;
            background-color: #FFFFFF;
            width: 80px;
            text-align: center;
            z-index: 1;
        }
        section.signUpContainer section.signUp .hr{
            position:absolute;
            background-color:black;
            height:1px;
            width:90%;
            left:20px;
            bottom:125px;
        }
        section.signUpContainer section.signUp p{
            text-align: center;
            letter-spacing: 1px;
        }
        section.signUpContainer section.signUp p a{
            text-decoration: none;
            color: #AF2213;
            cursor: pointer;
        }
        section.signUpContainer section.signUp .signUpContainer,
        section.signUpContainer section.signUp .logInContainer{
            padding: 10px;
            height: 70%;
            min-height: 400px;
            background-color: #FFFFFF;
            width: 350px;
            border: 2px solid rgb(0, 0, 0);
            flex-direction: column;
            margin: auto 0;
        }
        /*LOG IN CONTAINER*/
        section.signUpContainer section.signUp .logInContainer{
            justify-content: center;
            display: flex;
            position:relative;
        }
        /*SIGN IN CONTAINER*/
        section.signUpContainer section.signUp .signUpContainer{
            display: none;
            position:relative;
        }
    </Style>
</head>
<body>
<section class="signUpContainer">
    <section class="title">
        <span class="logo"><i class='bx bx-time'></i></span>
        <h1>
            <span>TimeMinder!</span>
            <p>Stay Reminded and Organized</p>
        </h1>  
    </section>

    <section class="signUp">
        <!-- LOG IN CONTAINER HERE -->
        <form class="logInContainer" method="post"> <!-- Corrected: Changed <forn> to <form> -->
            <h1 class="title">LOG IN</h1>
            <input type="email" name="logEmail" id="logEmail" placeholder="Email" pattern=".*@depedqc\.ph$" title="Please enter a valid Deped email ending with @depedqc.ph" required>
            <input type="password" name="logPassword" id="logPassword" placeholder="Password">
            <input type="submit" value="Log In" name="login"> <!-- Corrected: Changed name to "login" -->
            <span>or</span>
            <div class="hr"></div>
            <button type="button" onclick="showSignUpContainer()">Sign Up</button> <!-- Corrected: Added type="button" -->
        </form>
        <!-- SIGN UP CONTAINER HERE-->
        <form action="" class="signUpContainer" method="post">
            <h1 class="title">SIGN UP</h1>
            <input type="text" name="signUsername" id="signUsername"  placeholder="Name">
            <input type="email" name="signEmail" id="signEmail" placeholder="Email" pattern=".*@depedqc\.ph$" title="Please enter a valid Deped email ending with @depedqc.ph" required>
            <input type="text" name="signPassword" id="signPassword"  placeholder="Password">
            <input type="submit" value=" Join Now!" name="signup">
            <p>Already on TimeMinder? <a onclick="showLogInContainer()">Sign In</a></p>
        </form>
    </section>
</section>
<script>
    //SIGN UP NAVIGATION
    const logInContainer = document.querySelector('.logInContainer'); // Corrected: Changed form.logInContainer to .logInContainer
    const signUpContainer = document.querySelector('form.signUpContainer'); // Corrected: Changed form.signUpContainer to .signUpContainer
    function showLogInContainer(){
        logInContainer.style.display="flex";
        signUpContainer.style.display="none";
    }
    function showSignUpContainer(){
        logInContainer.style.display="none";
        signUpContainer.style.display="flex";
    }
</script>
</body>
</html>