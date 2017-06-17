<?php
    session_start();
    include('connect.php');

    if(isset($_POST["ansubmit"])){
        function valid($data){
            $data = trim(stripslashes(htmlspecialchars($data)));
            return $data;
        }
        $answer = valid($_POST["answer"]);
        if($answer == NULL){
            echo "<script>window.alert('Please Enter something.');</script>";
        }
        else{
            $que = "";
            if($_POST["nul"]==0){
                if(strpos($_POST["preby"],$_SESSION["user"]) === false)
                    $que = "update quans set answer=CONCAT(answer,'<br>or<br>".$_POST["answer"]."'), answeredby=CONCAT(answeredby,', @ ".$_SESSION["user"]."') where question like '%".$_POST["question"]."%'";
                else
                    $que = "update quans set answer=CONCAT(answer,'<br>or<br>".$_POST["answer"]."'), answeredby = '".$_SESSION["user"]."' where question like '%".$_POST["question"]."%'";
            }
            else
                $que = "update quans set answer='".$_POST["answer"]."', answeredby = '".$_SESSION["user"]."' where question like '%".$_POST["question"]."%'";
            if(mysqli_query($conn,$que))
                echo "<style>#box0,.open{display: none;} #tb{display: block;}</style>";
            else
                header("Location: index.php");
        }
    }

?>
<!DOCTYPE html>
<html>
    <head>
        <title> Interrogate </title>
        <link type="text/css" rel="stylesheet" href="css/style.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link type="text/css" rel="stylesheet" href="css/material.css">
        <link type="text/css" rel="stylesheet" href="fonts/font.css">
        <link rel="icon" href="images/icon1.png" >
        <!-- Sripts -->
        <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
        <script type="text/javascript" src="js/script.js"></script>
        <style>
            textarea{
                display: none;
                width: 300px;
                height: 50px;
                background: #333;
                color: #ddd;
                padding: 10px;
                margin: 5px 0 -14px; 
            }
            .ans_sub{
                display: none;
                padding: 0 10px;
                height: 30px;
                line-height: 30px;
            }
            .pop{
                display: none;
                text-align: center;
                margin: 195.5px auto;
                font-size: 12px;
            }
        </style>
    </head>
    <body id="_3">
        <!-- navigation bar -->
        <a href="index.php">
            <div id="log">
                <div id="i">i</div><div id="cir">i</div><div id="ntro">nterrogate</div>
            </div>
        </a>
        <ul id="nav-bar">
            <a href="index.php"><li>Home</li></a>
            <a href="categories.php"><li id="home">Categories</li></a>
            <a href="contacts.php"><li>Contact</li></a>
            <a href="ask.php"><li>Ask Question</li></a>
            <?php 
                if(! isset($_SESSION['user'])){
            ?>
            <a href="login.php"><li>Log In</li></a>
            <a href="signup.php"><li>Sign Up</li></a>
            <?php
                }
                else{
            ?>
            <a href="profile.php"><li>Hi, <?php echo $_SESSION["user"]; ?></li></a>
            <a href="logout.php"><li>Log Out</li></a>
            <?php
                }
            ?>
        </ul>
        
        <!-- content -->
        <div id="content">
            <h4>
                <a id="title-head" href="categories.php">Categories</a>
            </h4>
            <div id="box0">
                <center>
                    <a id="ada" href="#box1">
                        <div id="algo" class="img">
                            <div id="p" title="Open">Algorithm</div>
                        </div>
                    </a>
                    <a id="cso" href="#box2">
                        <div id="archi" class="img">
                            <div id="p" title="Open">Architecture</div>
                        </div>
                    </a>
                    <a id="t" href="#box3">
                        <div id="toc" class="img">
                            <div id="p" title="Open">Theory of Computation</div>
                        </div>
                    </a>
                </center>
                <center>
                    <a id="db" href="#box4">
                        <div id="database" class="img">
                            <div id="p" title="Open">Database Management</div>
                        </div>
                    </a>
                    <a id="pqt" href="#box5">
                        <div id="prob" class="img">
                            <div id="p" title="Open">Probability &amp; Queuing Theory</div>
                        </div>
                    </a>
                    <a id="se" href="#box6">
                        <div id="soft" class="img">
                            <div id="p" title="Open">Software Engineering</div>
                        </div>
                    </a>
                </center>
            </div>
            <div class="pop" id="tb">
                <center><h1><b style="font-size: 1.5em; margin: -60px auto 10px; display: block;">:)</b>Thank You For Your Answer.</h1></center>
            </div>
            <center>
                <?php
                    $no = 1;
                    $n = 1;
                    $nul=0; 
                    while($no < 7){
                ?>
                <div id="box<?php echo $no; ?>" class="open">
                    <a href=""><div id="close">X</div></a>
                    <div id="topic">
                        <?php 
                            echo "<h2 id='topic-head'>";
                            $q = 'select name, description from category where id='.$no;
                            $r = mysqli_query($conn,$q);

                            $d = mysqli_fetch_assoc($r);
                            echo $d['name'].'</h2><p id="topic-desc">'.$d['description']."<br>Explore our home page for more questions.</p>";
                        ?>
                    </div>
                    
                    <center>
                        <?php
                            $qu = "select q.question, q.answer, q.askedby, q.answeredby from quans as q, quacat as r, category as c where q.id=r.id and r.category=c.name and c.id='$no' Limit 8";
                            $re = mysqli_query($conn,$qu);
                            while($da = mysqli_fetch_assoc($re)){
                        ?>
                        <div id="qa-block">
                            <div class="question">
                                <div id="Q">Q.</div>
                                <?php echo $da['question']."<small id='sml'>Asked By: @".$da['askedby']."</small>"; ?>
                            </div>
                            <div class="answer">
                                <?php 
                                    if($da["answer"]){
                                        $nul=0;
                                        echo $da["answer"]."<br><small>Answered By: @".$da['answeredby']."</small>";
                                    }
                                    else{
                                        $nul=1;
                                        echo "<em>*** Not Answered Yet ***</em>";
                                    }
                                ?>
                                
                                <form id="f<?php echo $n; ?>" style="margin-bottom: -25px;" action="<?php echo htmlspecialchars( $_SERVER["PHP_SELF"] ); ?>" method="post" enctype="multipart/form-data">
<!--                                    <input type="button" value="Click here to answer." id="ans_b" >-->
                                    <label style="margin-bottom: -25px;"><a id="ans_b<?php echo $n; ?>" href="#area<?php echo $no; ?>"><u>Submit your answer</u></a></label>
                                    <br>
                                    <script>
                                        $(function(){
                                            $('#ans_b<?php echo $n; ?>').click(function(e){
                                                e.preventDefault();
                                                $('#area<?php echo $n; ?>').css("display","block");
                                                $('#ar<?php echo $n; ?>').css("display","block");
                                                $('#f<?php echo $n; ?>').css("margin-bottom","0px");
                                            });
                                        });
                                    </script>
                                    <textarea id="area<?php echo $n; ?>" name="answer" placeholder="Your Answer..."></textarea>
                                    <input style="display: none;" name="question" value="<?php echo $da['question'] ?>">
                                    <input style="display: none;" name="nul" value="<?php echo $nul ?>">
                                    <input style="display: none;" name="preby" value="<?php echo $da['answeredby'] ?>">
                                    <br>
                                    <input type="submit" name="ansubmit" value="Submit" class="up-in ans_sub" id="ar<?php echo $n; ?>">
                                    
                                </form>
                                

                                
                            </div>
                        </div>
                        <?php $n++; } ?>
                    </center>
                    
                </div><!-- box1 -->
                <?php
                    $no++;
                }
                ?>
            </center>
            
        </div><!-- content -->
        
        <!-- Footer -->
        <div id="footer">
            &copy; 2017 &bull; Interrogate Inc.
        </div>
        
        
    </body>
    
</html>