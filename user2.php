<?php
                   if(isset($_SESSION['username'])){
                    $ur=$_SESSION['username'];
                   echo'<a href="?logout">Log out</a>';
                 }
                 else{
                   echo'<a href="sign.php">Sign in</a>';
                 }
                
                ?>