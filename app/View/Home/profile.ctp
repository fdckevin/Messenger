 <div class="row">
            <div class="col-12 mt-5">
                <div class="card">

                    <div class="card-body">
                        <div class="card-title mb-4">
                            <div class="d-flex justify-content-start">
                                <div class="image-container" style="width: 84%;">
                                    
                                    <img id="imgProfile" style="width: 150px; height: 150px" />
      
                                </div>
                                <div>
                                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#profileModal"><i class="fa fa-pencil" aria-hidden="true"></i> Edit Profile</button>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="tab-content ml-1" id="myTabContent">
                                    <div class="tab-pane fade show active" id="basicInfo" role="tabpanel" aria-labelledby="basicInfo-tab">
                                        

                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;">Name</label>
                                            </div>
                                            <div class="col-md-8 col-6" id="p_name">
                                                
                                            </div>
                                        </div>
                                        <hr />

                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;">Email</label>
                                            </div>
                                            <div class="col-md-8 col-6" id="p_email">
                                                
                                            </div>
                                        </div>
                                        <hr />
                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;">Phone</label>
                                            </div>
                                            <div class="col-md-8 col-6" id="p_phone">
                                                
                                            </div>
                                        </div>

                                         <hr />

                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;">Created</label>
                                            </div>
                                            <div class="col-md-8 col-6" id="p_created">
                                                
                                            </div>
                                        </div>
                                        <hr />
                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;">Modified</label>
                                            </div>
                                            <div class="col-md-8 col-6" id="p_modified">
                                                
                                            </div>
                                        </div>

                                    </div>
                                    <div class="tab-pane fade" id="connectedServices" role="tabpanel" aria-labelledby="ConnectedServices-tab">
                                        Facebook, Google, Twitter Account that are connected to this account
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>

                </div>
            </div>
        </div>

        <!-- The Modal -->
<div class="modal" id="profileModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Edit Profile</h4>
       <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
        <form id="profileForm" enctype="multipart/form-data">
           <label for="name">Image:</label>
          <!-- <div class="mb-3 mt-3">
            <input type="file" class="form-control-file border" name="image" id="image" >
          </div> -->
           <div class="image-container">
                <img id="imgProfile2" src="<?php echo $this->webroot;?>img/user_none.png" style="width: 150px; height: 150px" class="img-thumbnail" />
          </div>
          <div class="mb-3 mt-3">
            <input type="file" class="form-control-file border" name="image" id="image" >
          </div>
          <div class="mb-3 mt-3">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="ep_name" placeholder="Enter name" name="name">
          </div>
          <div class="mb-3">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="ep_email" placeholder="Enter email" name="email">
          </div>
          <div class="mb-3">
            <label for="birthdate">Phone:</label>
            <input type="text" class="form-control" id="ep_phone" name="phone">
          </div>
          <button class="btn btn-primary" id="btnSave" name="btnSave">Save</button>
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

        getProfile();

        $('#image').on('change', function () {
            readURL(this);
        });

        $('#profileForm').submit(function(e){

                e.preventDefault();

                var extension = $('#image').val().split('.').pop().toLowerCase();
                var image = $('#image').val();
                var name = $('#ep_name').val();
                var email = $('#ep_email').val();
                var phone = $('#ep_phone').val();

                var message = "";

                if(name==''||email==''||phone=='') {

                    if(name=='') {

                        message += "Name is required\n";
                    }

                    if(email=='') {

                        message += "Email is required\n";
                    }

                    if(phone=='') {

                        message += "Phone is required\n";
                    }

                    alert(message);

                    return false;
                }

                if(image!='') {
                    if(jQuery.inArray(extension, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
                        alert('Invalid File');
                        return false;
                    }
                }

                $.ajax({

                    url: '<?php echo $this->Html->url('/home/editprofile');?>',
                    method: 'POST',
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    success: function(data) {
                       
                        var data = JSON.parse(data);

                        if(data.success==1) {

                            alert(data.message);

                            $('#imgProfile2').attr('src', '<?php echo $this->webroot;?>img/user_none.png');
                            $('#profileForm')[0].reset();

                            $('#profileModal').modal('hide');

                            getProfile();
                        }
                    },
                    error: function(jqXHR, status, error) {
                      console.log(status);
                      console.log(error);
                    }
                });
            });
    });

    function getProfile() {

        $.ajax({

            url: '<?php echo $this->Html->url('/home/profile');?>',
            method: 'POST',
            data: {
                profile: 1
            },
            async: false,
            success: function(data) {

                var data = JSON.parse(data);

                data = data[0];

                if(data['image']!=null && data['image']!="") {

                    $('#imgProfile').attr('src', '<?php echo $this->webroot;?>img/'+data['image']);
                } else {

                    $('#imgProfile').attr('src', '<?php echo $this->webroot;?>img/user_none.png');
                }

                $('#p_name').html(data['name']);
                $('#p_email').html(data['email']);
                $('#p_phone').html(data['phone']);
                $('#p_created').html(moment(data['created']).format('MMMM DD, YYYY h:mm a'));
                $('#p_modified').html(moment(data['modified']).format('MMMM DD, YYYY h:mm a'));

                $('#ep_name').val(data['name']);
                $('#ep_email').val(data['email']);
                $('#ep_phone').val(data['phone']);
            }
        });
    }

    function readURL(input) {

                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('#imgProfile2').attr('src', e.target.result);
                    };

                    reader.readAsDataURL(input.files[0]);
                }
            }
</script>