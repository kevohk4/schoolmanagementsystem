<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatibile" content="IE-edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body class="light-mode">
    
    <!--header design-->
    <header class="headernav">
        <a href="#" class="logo">Tuchapiane</a>
        <div class="bx bx-menu" id="menu-icon"></div>
        <nav class="navbar">

            @if (Route::has('login'))

                    @auth
                        <a href="{{ url('/home') }}">Profile</a>
                        <a href="/friends">Friends</a>
                        <a href="/messages">Messages</a>
                        <a href="/notifications">Notification</a>
                        <a><button id="modeToggle" style="background: transparent;font-size:20px"><i class='bx bxs-moon' style='color:black'></i></button></a>
                    @else
                        <a href="{{ route('login') }}">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                        @endif
                    @endauth

            @endif

        </nav>
    </header>

    <section>
    <div class="box">
                    <div class="profile">
   
                        <p><img src='' width='100%' height='200px'></p>
                        <br>
                        <b>Name: Kevin </b><br>
                
                        <b>Country : Kenya </b><br>
                        <b>Email : email@gmail.com </b><br>   
                        <div id=''>
                            <a href='message'>Edit profile</a>
                        </div>                                                               
                
                    </div>
                </div>

                <div class="box" style="height: 120px;background-color: black;">
                    <div class="post">
                        <div class="content">
                            <div class="card">
                                <div class="inner">
                    
                                    <p> <img src='' width='50px' height='50px'> Kevin Odhiambo </p>
                                    <img src='' width='100%' height='100%'>
                                    <br>
                                    <b> Who has been to Kenya </b>
                                    <br>
                                    <br>
                                    <b> Likes: 28  <a href='comments.php'> Comments: 36</a> <br>
                                    <i class='bx bxs-comment-detail' style='color:#ffffff' ></i>  <i class='bx bxs-heart' style='color:#ffffff' ></i> <i class='bx bx-heart' style='color:#ffffff' ></i>

                                    <br><br>                                                                
                                </div>
                            </div>
                        </div>


                        <div class="content">
                            <div class="card">
                                <div class="inner">
                    
                                    <p> <img src='' width='50px' height='50px'> Kevin Odhiambo </p>
                                    <img src='' width='100%' height='100%'>
                                    <br>
                                    <b> Who has been to Kenya </b>
                                    <br>
                                    <br>
                                    <b> Likes: 28  <a href='comments.php'> Comments: 36</a> <br>
                                    <i class='bx bxs-comment-detail' style='color:#ffffff' ></i>  <i class='bx bxs-heart' style='color:#ffffff' ></i> <i class='bx bx-heart' style='color:#ffffff' ></i>

                                    <br><br>                                                                
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
    </section>

    <footer style="background-color:grey;text-align:center;padding:10px">
    <h5>Copyright 2023</h5>

    </footer>


    




    

    

    

</body>
</html>
  
           

            

     