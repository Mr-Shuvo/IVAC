<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>

        *, *:before, *:after {
            box-sizing: inherit;
        }

        .column {
            float: left;
            width: 31.3%;
            margin-bottom: 16px;
            padding: 0 8px;
        }
        .cardimg{
            height: 280px;
        }
        @media screen and (max-width:300px) {
            .column {
                width: 100%;
                display: block;
            }
        }

        .card {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        }

        .container {
            padding: 0 12px;
        }

        .container::after, .row::after {
            content: "";
            clear: both;
            display: table;
        }

        .title {
            color: grey;
        }

    </style>
</head>
<body >

<h2 align="center">Meet Our Professional Team Member</h2>
<br>
<div class="row"  style="box-sizing: border-box"  >
    <div class="column">
        <div class="card">
            <img class="cardimg" src="images/shuvo.jpg" alt="Jane" style="width:100%">
            <div class="container">
                <h2>Shuvo Mukherjee</h2>
                <p class="title">System Developer</p>
                <p>B.S.c In Computer Science & Engineering<br>Daffodil International University<br> shuvo3966@diu.edu.bd</p>
            </div>
        </div>
    </div>

    <div class="column">
        <div class="card">
            <img class="cardimg" src="images/shardul.jpg" alt="Mike" style="width:100%">
            <div class="container">
                <h2>Shardul Mahmud</h2>
                <p class="title">System Director & Designer</p>
                <p>B.S.c In Computer Science & Engineering<br>Daffodil International University<br> shardul4110@diu.edu.bd</p>

            </div>
        </div>
    </div>
    <div class="column">
        <div class="card">
            <img class="cardimg" src="images/zamiul.jpg" alt="John" style="width:100%">
            <div class="container">
                <h2>MD. Zamiul Islam</h2>
                <p class="title">CEO & Founder</p>
                <p>B.S.c In Computer Science & Engineering<br>Daffodil International University<br> zamiul4097@diu.edu.bd</p>

            </div>
        </div>
    </div>
</div>

</body>
</html>
