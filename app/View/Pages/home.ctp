   <div class="row justify-content-center align-items-center" style="height:100vh">
            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                        <h2 class="text-center">Login</h2>
                        <form class="mt-3" id="loginForm" autocomplete="off">
                            <div class="form-group">
                            	<label for="email">Email Address:</label>
                                <input type="text" id="l-email" class="form-control" name="email">
                            </div>
                            <div class="form-group">
                            	<label for="password">Password:</label>
                                <input type="password" id="l-pass" class="form-control" name="password"> 
                            </div>
                            <div class="text-right">
                                <a href="<?php echo $this->Html->url('/register');?>" class="text-info">Register here</a>
                            </div>
                            <button id="btnLogin" class="btn btn-primary">login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

<script type="text/javascript">
    
    $(document).ready(function(){

        $('#loginForm').submit(function(e){

            e.preventDefault();

            var email = $('#l-email').val();
            var pass = $('#l-pass').val();

            var message = '';

            if(email==''||pass=='') {

                if(email=='') {

                    message += 'Email is required\n';
                }

                if(pass=='') {

                    message += 'Password is required\n';
                }

                alert(message);

                return false;
            }

            $.ajax({

                url: '<?php echo $this->Html->url('/login');?>',
                method: 'POST',
                data: new FormData(this),
                contentType: false,
                processData: false,
                success: function(data) {

                    var data = JSON.parse(data);

                    if(data.success==1) {

                        window.location.href = '<?php echo $this->Html->url('/home');?>';
                    } else {
                        alert(data.message);
                    }
                },
                error: function(jqXHR, error, status) {

                    console.log(error);
                    console.log(status);
                }
            });
        });
    });
</script>