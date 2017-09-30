<div class="left">
    <div class="author-name">
        Mick Lane
        <small class="chat-date">
            08:45 pm
        </small>
    </div>
    <div class="chat-message active">
        I belive that. Lordddem Ipsum is simply dummy text.
    </div>
</div>
<div class="small-chat-box fadeInRight animated">

    <div class="heading" draggable="true">
        <small class="chat-date pull-right">
            02.19.2015
        </small>
        Small chat
    </div>

    <div class="content" id="chatcontent">



    </div>
    <div class="form-chat">
        <div class="input-group input-group-sm"><input type="text" class="form-control"> <span class="input-group-btn"> <button
                        class="btn btn-primary" type="button">Send
            </button> </span></div>
    </div>

</div>
<div id="small-chat"  onclick="getId();">

    <span class="badge badge-warning pull-right">5</span>
    <a class="open-small-chat">
        <i class="fa fa-comments"></i>

    </a>
</div>

<script>
    function getId(){
        //We create ajax function
        $.ajax({
            type: "POST",
            url: "php/showcontent.php",
            success: function(data){
                $("#chatcontent").html(data);
            }
        });
        setInterval(getId,5000);
    }
</script>
