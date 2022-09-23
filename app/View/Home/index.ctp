<h3 class="text-center mt-3">Messenger</h3>
<div class="messaging">
      <div class="inbox_msg">
        <div class="inbox_people">
          <div class="headind_srch">
            <div class="recent_heading">
              <h4>Inbox</h4>
            </div>
            <div class="srch_bar">
              <div class="stylish-input-group">
                <input type="text" class="search-bar"  placeholder="Search" >
                <span class="input-group-addon">
                <button type="button"> <i class="fa fa-search" aria-hidden="true"></i> </button>
                </span> </div>
            </div>
            <div>
              <button id="btnNew" class="btn btn-info mt-3" style="float: right;">New Message</button>
            </div>
          </div>
          <div class="inbox_chat">
            <div id="chat_list"></div>
          </div>
        </div>
        <div class="mesgs">
          <div class="msg_history">
            <div id="msg_replies"></div>
          </div>
          <div class="type_msg">
            <div class="input_msg_write">
              <form id="replyForm">
              <input type="hidden" id="message_id" name="message_id">
              <input type="text" class="write_msg" placeholder="Type a message" id="comment" name="comment"/>
              <button class="msg_send_btn"><i class="fa fa-paper-plane-o" aria-hidden="true"></i></button>
            </form>
            </div>
          </div>
        </div>
      </div>  
    </div>

    <!-- The Modal -->
<div class="modal" id="messageModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">New Message</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
            <form id="messageForm">
          <div class="mb-3 mt-3">
            <label for="recipient">Recipient:</label>
            <div id="recipients"></div>
          </div>
            <div class="form-group">
                <label for="message">Message:</label>
                <textarea class="form-control" rows="5" id="body" name="body" placeholder="Message"></textarea>
            </div>
          <button class="btn btn-primary" id="btnSend" name="btnSave">Send</button>
        </form>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
<script type="text/javascript">
  
  $(document).ready(function(){

    var socket = io.connect('http://localhost:4000');

    socket.on('receive-message', (msg) => {

      if(msg==1) {
        getMessageLists();
      }
    });

    socket.on('receive-reply', (room) => {

      console.log('load conversation on room '+room);
      loadReplies(room);
    });

    getRecipients();

    getMessageLists();

    $('.type_msg').hide();

    $('#btnNew').click(function(){

      $('#messageModal').modal('show');
    });

    $('#recipient').select2({

      templateResult: recipientStyles,
      dropdownParent: $('#messageModal')
    });

    $('#messageForm').submit(function(e){

      e.preventDefault();

      var recipient = $('#recipient').val();
      var body = $('#body').val();

      var message = '';

      if(recipient==''||body=='') {

        if(recipient=='') {

          message += 'Recipient is required\n';
        }

        if(body=='') {

          message += 'Body is required\n';
        }

        alert(message);

        return false;
      }

      $.ajax({
        url: '<?php echo $this->Html->url('/home/newmessage');?>',
        method: 'POST',
        data: new FormData(this),
        contentType: false,
        processData: false,
        success: function(data) {

          var data = JSON.parse(data);

          if(data.success==1) {

            alert(data.message);

            $('#messageForm')[0].reset();

            $('#messageModal').modal('hide');

            socket.emit('message', 1)

            // getMessageLists();
          }
        },
        error: function(jqXHR, error, status) {

          console.log(error);
          console.log(status);
        }
      })
    });

    $('#replyForm').submit(function(e){

      e.preventDefault();

      var comment = $('#comment').val();

      if(comment=='') {

        alert('Please write something');

        return false;
      }

      $.ajax({

        url: '<?php echo $this->Html->url('/home/reply');?>',
        method: 'POST',
        data: new FormData(this),
        contentType: false,
        processData: false,
        success: function(data) {

          var data = JSON.parse(data);

          if(data.success==1) {

            $('#replyForm')[0].reset();

            // loadReplies(data['id']);
            socket.emit('reply', data['id']);


          }
        },
        error: function(jqXHR, error, show) {

          console.log(error);
          console.log(show);
        }
      });
    });

    $(document).on('click', '.chat_list', function(){

      var id = $(this).attr('id');

      $('#message_id').val(id);

      $('.type_msg').show();

      $('#comment').focus();

      loadReplies(id);

      socket.emit("join", id);

    });

  });

  function getRecipients() {

      $.ajax({

        url: '<?php echo $this->Html->url('/home/getrecipients');?>',
        method: 'POST',
        async: false,
        data: {
          recipients: 1
        },
        success: function(data) {

          var data = JSON.parse(data);

          if(data.success==1) {

            $('#recipients').html(data['recipients']);
          }
        }
      });
    }

    function getMessageLists() {

      $.ajax({

        url: '<?php echo $this->Html->url('/home/getmessages');?>',
        method: 'POST',
        async: false,
        data: {
          message: 1
        },
        success: function(data) {

          var data = JSON.parse(data);

          data = data['messages'];

          var output = "";


          for(var i=0; i<data.length; i++) {

            // if(i==0) {
            //   output+="<div class='chat_list active_chat'>";
            // } else {
            //   output+="<div class='chat_list'>";
            // }
            output+="<div id='"+data[i]['Message']['id']+"' class='chat_list'>";
            output+="<div class='chat_people'>";
            output+="<div class='chat_img'> <img src='<?php echo $this->webroot;?>img/"+data[i]['User']['image']+"' alt='sunil'> </div>";
            output+="<div class='chat_ib'>";
            output+="<h5>"+data[i]['User']['name']+" <span class='chat_date small text-muted'>"+moment(data[i]['Message']['created']).format('MMM Do YYYY, h:mm a')+"</span></h5>";
            output+="<p>"+data[i]['Message']['body']+"</p>";
            output+="</div></div></div>";

          }

          $('#chat_list').html(output);
        }
      });
    }

    function loadReplies(id) {

      $.ajax({

        url: '<?php echo $this->Html->url('/home/getreplies');?>',
        method: 'POST',
        async: false,
        data: {
          message_id: id
        },
        success: function(data) {

          var data = JSON.parse(data);

          var loggedID = data['loggedID'];

          console.log(loggedID);

          data = data['replies'];

          var output = "";

          for(var i=0; i<data.length; i++) {

            if(data[i]['User']['id']==loggedID) {
              output+="<div class='outgoing_msg'>";
              output+="<div class='sent_msg'>";
              output+="<p>"+data[i]['Reply']['comment']+"</p>";
              output+="<span class='time_date'>"+moment(data[i]['Reply']['created']).format('MMM Do YYYY, h:mm a')+"</span> </div></div>";
            } else {

              output+="<div class='incoming_msg'>";
              output+="<div class='incoming_msg_img'>";
              output+="<img src='<?php echo $this->webroot;?>img/"+data[i]['User']['image']+"' alt='sunil'> </div>";
              output+="<div class='received_msg'>";
              output+="<div class='received_withd_msg'>";
              output+="<p>"+data[i]['Reply']['comment']+"</p>";
              output+="<span class='time_date'>"+moment(data[i]['Reply']['created']).format('MMM Do YYYY, h:mm a')+"</span></div></div>";
            }
          }

          console.log(output);

          $('#msg_replies').html(output);
        }
      });
    }

    function recipientStyles (selection) {
        if (!selection.id) { return selection.text; }
        var thumb = $(selection.element).data('thumb');
        if(!thumb){
          return selection.text;
        } else {
          var $selection = $(
        '<span><img src="<?php echo $this->webroot;?>img/' + thumb + '" width="32" height="32" class="img-flag" alt=""><span class="img-changer-text">' + $(selection.element).text() + '</span>'
      );
      return $selection;
      }
    }
</script>