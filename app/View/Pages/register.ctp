   <div class="row justify-content-center align-items-center" style="height:100vh">
            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                        <h2 class="text-center">Register</h2>
                        <form class="mt-3" id="registerForm" autocomplete="off">
                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" id="r-name" class="form-control" name="name">
                            </div>
                            <div class="form-group">
                            	<label for="email">Email Address:</label>
                                <input type="text" id="r-email" class="form-control" name="email">
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone:</label>
                                <input type="text" id="r-phone" class="form-control" name="phone">
                            </div>
                            <div class="form-group">
                            	<label for="password">Password:</label>
                                <input type="password" id="r-pass" class="form-control" name="password">
                            </div>
                            <div class="form-group">
                                <label for="confirm-password">Confirm Password:</label>
                                <input type="password" id="r-pass2" class="form-control">
                            </div>
                            <div class="text-right">
                                <a href="<?php echo $this->Html->url('/');?>" class="text-info">Back to login</a>
                            </div>
                            <button id="btnRegister" class="btn btn-primary">register</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

<script type="text/javascript">
    
    $(document).ready(function(){

        $('#registerForm').submit(function(e){

            e.preventDefault();

            var name = $('#r-name').val();
            var email = $('#r-email').val();
            var phone = $('#r-phone').val();
            var pass = $('#r-pass').val();
            var pass2 = $('#r-pass2').val();

            var message = '';

            if(name==''||email==''||phone==''||pass==''||pass2=='') {

                if(name=='') {

                    message += 'Name is required\n';
                }

                if(email=='') {

                    message += 'Email is required\n';
                }

                if(phone=='') {

                    message += 'Phone is required\n';
                }

                if(pass=='') {

                    message += 'Password is required\n';
                }

                if(pass2=='') {

                    message += 'Confirm Password is required\n';
                }

                alert(message);

                return false;
            }

            if(name.length < 8) {

                message += 'Name should be at least 8 characters';

                alert(message);

                return false;

            }

            if(pass != pass2) {

                message += 'Password not match';

                alert(message);

                return false;
            }

            $.ajax({

                url: '<?php echo $this->Html->url('/register');?>',
                method : 'POST',
                data: new FormData(this),
                contentType: false,
                processData: false,
                success: function(data) {

                    var data = JSON.parse(data);

                    if(data.success==1) {

                        alert(data.message);

                        $('#registerForm')[0].reset();
                    } else {

                        alert(data.messageErr);
                    }
                },
                error: function(jqXHR, error, status) {

                    console.log(error);
                    console.log(status);
                }
            })

        });
    });
</script>