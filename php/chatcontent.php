<div id="main">
    <div class="chat-discussion result">
        <?php
        session_start();
        $_SESSION['timestamp'] = time();
        include_once "connection.php";

        $messagesresult = mysqli_query($con, "Select message.messageid, administrator.administratorname, administrator.administratorid, message.messagedata, message.createddate From message Inner Join administrator On administrator.administratorid = message.administratorid Order By message.createddate Desc LIMIT 100")or die(mysqli_error($con));

        while($messages = mysqli_fetch_assoc($messagesresult)){
            ?>
            <div class="chat-message left">
                <img class="message-avatar" src="img/test.jpg" alt="" >
                <div class="message">
                    <a class="message-author" href="#"> <font size="3"><?php echo $messages['administratorname'] ?> </font></a>
                    <span class="message-date">
                        <font size="1">
                            <?php
                            echo date("j F Y, g:i a", strtotime($messages['createddate']));;
                            ?>
                        </font>
					</span>
                    <span class="message-content">
                        <font size="2">
                            <?php
                            echo $messages['messagedata'];
                            ?>
                        </font>
					</span>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
</div>
