@extends ('backend.layouts.app')

@section('content')

    <div class="people-list" id="people-list">
      <div class="search">
        <input type="text" placeholder="{{__('strings.frontend.search')}}" />
        <i class="fa fa-search"></i>
      </div>
      <ul class="list">
        <?php if (count($customers)) { ?>
            <?php foreach ($customers as $thread_subject=>$customer) { ?>
                <?php
                    $active = '';
                    if ($customer_id == $customer['user_id'] AND $customer_thread->subject == $thread_subject) {
                      $active = 'active';
                    }
                  
                  ?>
                <li class="clearfix customerProfile <?php echo $active; ?>" data-href="<?php echo url('admin/messages/'. $customer['thread_id']); ?>" data-customer-id="<?php echo $customer['user_id']; ?>">
                    
                    <div class="">
                      <?php
                        if (!empty($customer['user_data']['avatar_location'])) {
                          $customer_avatar = \Storage::url($customer['user_data']['avatar_location']);
                        } else {
                          $customer_avatar = \Storage::url('/images/login.png');
                        }
                      ?>                    
                      <img src="<?php echo $customer_avatar; ?>" width="50" alt="<?php echo $customer['user_data']['fullname']; ?>" />
                    </div>
                    
                    <?php /*<img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/195612/chat_avatar_01.jpg" alt="avatar" /> */ ?>
                    <div class="about">
                        <div class="name"><?php echo $customer['user_data']['fullname']; ?> - <?php echo $customer['instance']?></div>

                        <div class="status d-none">
                            <i class="fa fa-circle online"></i> {{ __('strings.backend.general.status.online') }}
                        </div>
                    </div>
                </li>
            <?php } ?>
        <?php } ?>
      </ul>
    </div>
    
    <div class="chat">
      <div class="chat-header clearfix">
        <?php /* <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/195612/chat_avatar_01_green.jpg" alt="avatar" /> */ ?>
        <div class="circle">
          <img src="<?php echo $customer_avatar; ?>" alt="avatar" width="100"/>        
        </div>
        
        <div class="chat-about">
          <div class="chat-with">{{ __('strings.backend.chatting_with') }} <?php echo $active_customer['user_data']['fullname']; ?></div>
          <div class="chat-num-messages d-none">already <?php echo $all_messages->count(); ?> {{ __('strings.backend.messages') }}</div>
        </div>
      </div> <!-- end chat-header -->
      
      <div class="chat-history">
        <ul>
            <?php if ($all_messages->count()) { ?>
                <?php foreach ($all_messages as $message) { ?>
                    <?php if ($message->user_id != auth()->user()->id ) { ?>
                        <li>
                            <div class="message-data">
                            <span class="message-data-name"><i class="fa fa-circle online"></i> <?php echo $message->user_data['fullname']; ?></span>
                            <span class="message-data-time"><?php echo strftime('%d %b, %Y %H:%M', strtotime($message->created_at)); ?></span>
                            </div>
                            <div class="message my-message">
                            {!! $message->body !!}
                            </div>
                        </li>                    
                    <?php } else { ?>
                        <li class="clearfix">
                            <div class="message-data align-right">
                            <span class="message-data-time" ><?php echo strftime('%d %b, %Y %H:%M', strtotime($message->created_at)); ?></span> &nbsp; &nbsp;
                            <span class="message-data-name" ><?php echo auth()->user()->fullname; ?></span> <i class="fa fa-circle me"></i>
                            
                            </div>
                            <div class="message other-message float-right">
                            {!! $message->body !!}
                            </div>
                        </li>                    
                    <?php } ?>
                <?php } ?>
            <?php } ?>          
        </ul>
        
      </div> <!-- end chat-history -->
      
      <div class="chat-message clearfix">
        <textarea name="message-to-send" id="message-to-send" placeholder ="{{ __('strings.backend.type_your_message') }}" rows="3"></textarea>        
        <button>{{ __('strings.backend.send') }}</button>

      </div> <!-- end chat-message -->
    </div> <!-- end chat -->
    

  <script id="message-template" type="text/x-handlebars-template">
    <li class="clearfix">
      <div class="message-data align-right">
        <span class="message-data-time" ><?php echo "{{time}}" ?></span> &nbsp; &nbsp;
        <span class="message-data-name" ><?php echo auth()->user()->fullname; ?></span> <i class="fa fa-circle me"></i>
      </div>
      <div class="message other-message float-right">
        <?php echo "{{messageOutput}}" ?>
      </div>
    </li>
  </script>

  <script id="message-response-template" type="text/x-handlebars-template">
    <li>
      <div class="message-data">
        <span class="message-data-name"><i class="fa fa-circle online"></i> <?php echo $active_customer['user_data']['fullname']; ?></span>
        <span class="message-data-time"><?php echo '{{time}}'; ?></span>
      </div>
      <div class="message my-message">
        <?php echo '{{response}}'; ?>
      </div>
    </li>
  </script>  
@endsection



@push('after-scripts')
 <script src="//cdnjs.cloudflare.com/ajax/libs/handlebars.js/3.0.0/handlebars.min.js"></script>   
 <script src="//cdnjs.cloudflare.com/ajax/libs/list.js/1.1.1/list.min.js"></script>   
<style>

.people-list {
  width: 30%;
  float: left;
      background: #94c2ed;
}
.people-list .search {
  padding: 20px;
}
.people-list input {
  border-radius: 3px;
  border: none;
  padding: 14px;
  color: white;
  background: #c6d0ff;
  width: 90%;
  font-size: 16px;
}
.people-list .fa-search {
  position: relative;
  left: -25px;
}
.people-list ul {
  padding: 20px;
  height: 770px;
}
.people-list ul li {
    padding-bottom: 20px;
    list-style: none;
    cursor: pointer; 
}

.people-list ul li:hover, .people-list ul li.active {
    background: #c4dff9; 
}

.people-list img {
  float: left;
}
.people-list .about {
  float: left;
  margin-top: 8px;
}
.people-list .about {
  padding-left: 8px;
}
.people-list .status {
  color: #92959e;
}
.chat {
  width: 60%;
  float: left;
  background: #f2f5f8;
  border-top-right-radius: 5px;
  border-bottom-right-radius: 5px;
  color: #434651;
}
.chat .chat-header {
  padding: 20px;
  border-bottom: 2px solid white;
}
.chat .chat-header img {
  float: left;
}
.chat .chat-header .chat-about {
  float: right;
  padding-left: 10px;
  margin-top: 6px;
}
.chat .chat-header .chat-with {
  font-weight: bold;
  font-size: 16px;
}
.chat .chat-header .chat-num-messages {
  color: #92959e;
}
.chat .chat-header .fa-star {
  float: right;
  color: #d8dadf;
  font-size: 20px;
  margin-top: 12px;
}
.chat .chat-history {
  padding: 30px 30px 20px;
  border-bottom: 2px solid white;
  overflow-y: scroll;
  height: 575px;
}
.chat .chat-history li {
    list-style:none;
}
.chat .chat-history .message-data {
  margin-bottom: 15px;
}
.chat .chat-history .message-data-time {
  color: #a8aab1;
  padding-left: 6px;
}
.chat .chat-history .message {
  color: white;
  padding: 18px 20px;
  line-height: 26px;
  font-size: 16px;
  border-radius: 7px;
  margin-bottom: 30px;
  width: 90%;
  position: relative;
}
.chat .chat-history .message:after {
  bottom: 100%;
  left: 7%;
  border: solid transparent;
  content: " ";
  height: 0;
  width: 0;
  position: absolute;
  pointer-events: none;
  border-bottom-color: #86bb71;
  border-width: 10px;
  margin-left: -10px;
}
.chat .chat-history .my-message {
  background: #86bb71;
}
.chat .chat-history .other-message {
  background: #94c2ed;
}
.chat .chat-history .other-message:after {
  border-bottom-color: #94c2ed;
  left: 93%;
}
.chat .chat-message {
  padding: 30px;
}
.chat .chat-message textarea {
  width: 100%;
  border: none;
  padding: 10px 20px;
  font: 14px/22px "Lato", Arial, sans-serif;
  margin-bottom: 10px;
  border-radius: 5px;
  resize: none;
}
.chat .chat-message .fa-file-o, .chat .chat-message .fa-file-image-o {
  font-size: 16px;
  color: gray;
  cursor: pointer;
}
.chat .chat-message button {
  float: right;
  color: #94c2ed;
  font-size: 16px;
  text-transform: uppercase;
  border: none;
  cursor: pointer;
  font-weight: bold;
  background: #f2f5f8;
}
.chat .chat-message button:hover {
  color: #75b1e8;
}
.online, .offline, .me {
  margin-right: 3px;
  font-size: 10px;
}
.online {
  color: #86bb71;
}
.offline {
  color: #e38968;
}
.me {
  color: #94c2ed;
}
.align-left {
  text-align: left;
}
.align-right {
  text-align: right;
}
.float-right {
  float: right;
}
.clearfix:after {
  visibility: hidden;
  display: block;
  font-size: 0;
  content: " ";
  clear: both;
  height: 0;
}

.circle {
    border: 2px solid #f2f5f8;
    overflow: hidden;
    width: 75px;
    height: 75px;
    border-radius: 100%;
    float: left;
}
.circle img{width:100%;}

</style>
<script>
(function(){  
  var chat = {
    messageToSend: '',
    messageResponses: [
      'Why did the web developer leave the restaurant? Because of the table layout.',
      'How do you comfort a JavaScript bug? You console it.',
      'An SQL query enters a bar, approaches two tables and asks: "May I join you?"',
      'What is the most used language in programming? Profanity.',
      'What is the object-oriented way to become wealthy? Inheritance.',
      'An SEO expert walks into a bar, bars, pub, tavern, public house, Irish pub, drinks, beer, alcohol'
    ],
    init: function() {
      this.cacheDOM();
      this.bindEvents();
      this.render();
    },
    cacheDOM: function() {
      this.$chatHistory = $('.chat-history');
      this.$button = $('button');
      this.$textarea = $('#message-to-send');
      this.$chatHistoryList =  this.$chatHistory.find('ul');
    },
    bindEvents: function() {
      this.$button.on('click', this.addMessage.bind(this));
      this.$textarea.on('keyup', this.addMessageEnter.bind(this));
    },
    render: function() {
      this.scrollToBottom();
      if (this.messageToSend.trim() !== '') {
        var template = Handlebars.compile( $("#message-template").html());
        var context = { 
          messageOutput: this.messageToSend,
          time: this.getCurrentTime()
        };

        this.$chatHistoryList.append(template(context));
        this.scrollToBottom();
        this.$textarea.val('');
        
        // responses
        var templateResponse = Handlebars.compile( $("#message-response-template").html());
        var contextResponse = { 
          response: this.getRandomItem(this.messageResponses),
          time: this.getCurrentTime()
        };
        
        // setTimeout(function() {
        //   this.$chatHistoryList.append(templateResponse(contextResponse));
        //   this.scrollToBottom();
        // }.bind(this), 1500);
        
      }
      
    },

    updateLatest: function () {
      var templateResponse = Handlebars.compile( $("#message-response-template").html());
      var contextResponse;
      var chatHistory = this.$chatHistoryList;

      ajaxUrl = '<?php echo url('/admin/messages/get_latest_messages'); ?>';

      $.ajax({
          type: 'GET',
          data: {
              _customer_id: <?php echo $customer_id; ?>,
              _thread_subject: '<?php echo $customer_thread->subject; ?>',
              _token: "{{ csrf_token() }}"
          },                                         
          context: this,
          url: ajaxUrl,
          dataType: 'json',                   
          success: function (response, textStatus, jqXHR) {
            if (response.data) {
              $.each(response.data.messages, function (k, val) {
                contextResponse = {
                  response: val.body,
                  time: val.created_at_formated
                };

                chatHistory.append(templateResponse(contextResponse));
              });
              this.scrollToBottom();
            }

          }
      })
    },
    
    addMessage: function() {
      this.messageToSend = this.$textarea.val()

        ajaxUrl = '<?php echo url('/admin/messages'); ?>';

        $.ajax({
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },            
            data: {
                _customer_id: <?php echo $customer_id; ?>,
                _thread_subject: '<?php echo $customer_thread->subject; ?>',
                _message: this.messageToSend,
                _token: "{{ csrf_token() }}"
            },                                         
            context: this,
            url: ajaxUrl,
            dataType: 'json',                   
            success: function (data, textStatus, jqXHR) {
                this.render();
            }
        })     
    },
    addMessageEnter: function(event) {
        // enter was pressed
        if (event.keyCode === 13) {
            this.addMessage();
        }
    },
    scrollToBottom: function() {
       this.$chatHistory.scrollTop(this.$chatHistory[0].scrollHeight);
    },
    getCurrentTime: function() {
      // moment.locale('ar-sa');
      // return moment().format('LLL');
      var event = new Date();
      var options = { year: 'numeric', month: 'short', day: '2-digit', hour: '2-digit', minute: '2-digit',  };

      return new Intl.DateTimeFormat('<?php echo app()->getLocale(); ?>', options).format(event);
    },
    getRandomItem: function(arr) {
      return arr[Math.floor(Math.random()*arr.length)];
    }
    
  };
  
  chat.init();

    setInterval(function () {
      chat.updateLatest();
    }, 3000)
  
  var searchFilter = {
    options: { valueNames: ['name'] },
    init: function() {
      var userList = new List('people-list', this.options);
      var noItems = $('<li id="no-items-found">No items found</li>');
      
      userList.on('updated', function(list) {
        if (list.matchingItems.length === 0) {
          $(list.list).append(noItems);
        } else {
          noItems.detach();
        }
      });
    }
  };
  
  searchFilter.init();
  
})();

$(function () {
    var redirectUrl = $(this).attr('data-href');

    $('.customerProfile').on('click', function (e) {
        e.preventDefault();
        ajaxUrl = '<?php echo url('/admin/ajax/set_session_value'); ?>';

        $.ajax({
            type: 'POST',
            data: {
                _session_key: "_customer_id",
                _session_value: $(this).attr('data-customer-id'),
                _token: "<?php echo e(csrf_token()); ?>"
            },
            beforeSend: function (jqXHR, settings) {
                $.blockUI({ css: { 
                    border: 'none', 
                    padding: '15px', 
                    backgroundColor: '#000', 
                    '-webkit-border-radius': '10px', 
                    '-moz-border-radius': '10px', 
                    opacity: .5, 
                    color: '#fff' 
                } }); 
            },  
            complete: function (jqXHR, textStatus) {
                //$.unblockUI();
            },                                         
            context: $(this),
            url: ajaxUrl,
            dataType: 'json',                   
            success: function (data, textStatus, jqXHR) {
                location.href = $(this).attr('data-href');
            }
        })
    }); 
});

</script>
@endpush