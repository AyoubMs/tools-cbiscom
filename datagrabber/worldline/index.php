<?php
include 'phphelper.php';

$ipRestrection();
// $createTokenTable();
$getRequestToken();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WorldLine DATA Grabber</title>

</head>

<body>
    <style>
        * {
            padding: 0;
            margin: 0;
        }

        body {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            position: relative;
            min-height: 100vh;
            font-family: Hack, monospace;
        }

        div {
            color: #727272;
            text-align: center;
        }

        p {
            margin: 16px;
            font-size: 50px;
            color: #ccc;
            text-transform: uppercase;
            font-weight: 600;
            transition: all 1s ease-in-out;
            position: relative;
        }

        p::before {
            content: attr(data-item);
            transition: all 1s ease-in-out;
            color: #8254ff;
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            width: 0;
            overflow: hidden;
        }

        p:hover::before {
            width: 100%;
        }

        nav {
            margin: 25px;
            background: #f9f9f9;
            padding: 16px;
        }

        nav .menuItems {
            list-style: none;
            display: flex;
        }

        nav .menuItems li {
            margin: 50px;
        }

        nav .menuItems li a {
            text-decoration: none;
            color: #8f8f8f;
            font-size: 18px;
            font-weight: 400;
            transition: all 0.5s ease-in-out;
            position: relative;
            text-transform: uppercase;
        }

        nav .menuItems li a::before {
            content: attr(data-item);
            transition: 0.5s;
            color: #8254ff;
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            width: 0;
            overflow: hidden;
        }

        nav .menuItems li a:hover::before {
            width: 100%;
            transition: all 0.5s ease-in-out;
        }

        footer {
            position: absolute;
            font-size: 12px;
            bottom: 0;
            width: 100%;
            height: 60px;
            line-height: 60px;
            font-size: 14px;
            background-color: #f1f1f1;
            color: #000;
            text-align: center;
        }

        footer a {
            text-decoration: none;
            color: inherit;
            border-bottom: 1px solid;
        }

        footer a:hover {
            border-bottom: 1px transparent;
        }

        input#token {
            font-size: 18px;
            padding: 10px;
            border-radius: 7px;
            border-color: #00000029;
        }

        label {
            font-size: 21px;
        }

        .tokendiv {
            margin-bottom: 30px;
        }
    </style>
    <script>
        var token

        function settoken(event) {
            console.log(event)
            document.getElementById("tokenform").submit();
        }
    </script>
    <!-- Developed by http://grohit.com/ -->
    <div>WorldLine</div>
    <p data-item='WorldLine Data Grabber'>WorldLine Data Grabber</p>
    <form action="" method="post" id="tokenform">
        <div class="tokendiv">
            <label for="token">Token</label>
            <input type="text" name="token" id="token" value="<?php echo $_SESSION["token"]; ?>" onchange="settoken(this)">
        </div>
    </form>
    <?php if ($tokenvalide) { ?>
        <section>
            <div>Menu</div>
            <nav>
                <ul class="menuItems">
                    <li><a href='./AgentActions.php?token=<?php echo $_SESSION["token"]; ?>&date=<?php echo date("Ymd"); ?>' data-item='AgentActions'>AgentActions</a></li>
                    <li><a href='./AgentLog.php?token=<?php echo $_SESSION["token"]; ?>&date=<?php echo date("Ymd"); ?>'' data-item=' AgentLog'>AgentLog</a></li>
                    <li><a href='./AgentStates.php?token=<?php echo $_SESSION["token"]; ?>&date=<?php echo date("Ymd"); ?>'' data-item=' AgentStates'>AgentStates</a></li>
                    <li><a href='./InboundCalls.php?token=<?php echo $_SESSION["token"]; ?>&date=<?php echo date("Ymd"); ?>'' data-item=' InboundCalls'>InboundCalls</a></li>
                    <li><a href='./ManualCalls.php?token=<?php echo $_SESSION["token"]; ?>&date=<?php echo date("Ymd"); ?>'' data-item=' ManualCalls'>ManualCalls</a></li>
                    <li><a href='./SurveyResults.php?token=<?php echo $_SESSION["token"]; ?>&date=<?php echo date("Ymd"); ?>'' data-item=' SurveyResults'>SurveyResults</a></li>
                </ul>
            </nav>

        </section>
    <?php } ?>

    <!-- Footer starts-->
    <footer>

        <!-- Copyright -->
        <!-- ❤️  -->
        <div class="footer-copyright text-center">NCC Casablanca</div>
        <!-- Copyright -->

    </footer>
    <!-- Footer ends-->

    <!-- Developed by http://grohit.com/ -->
</body>

</html>