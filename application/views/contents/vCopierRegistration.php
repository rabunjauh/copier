<div class="container box">	
	<div class="row">
		<div class="col-lg-6">
			<h1>Printer Registration Data</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-6">			
			<a href="<?php echo base_url('c_employee_details/register_password'); ?>" class="btn btn-primary my-1">Register User</a>
			<a href="<?php echo base_url('c_employee_details/export_register'); ?>" class="btn btn-success my-1">Download Register</a>
			<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#myModal">
                Form Upload Register
            </button>
		</div>
	</div>	
	<hr>
	<div class="row">
		<div class="col-lg-12">
            <table class="table table-bordered" id="registrationData">
                <thead>
                    <tr>
                        <th></th>
                        <th>No</th>
                        <th>Employee ID</th>
                        <th>Sharp Password</th>
                        <th>Others Password</th>
                        <th>Employee Name</th>
                        <th>Department</th>
                        <th>Job Title</th>
                        <th>Email</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>
            </table>
            <!-- <?php echo $this->pagination->create_links(); ?> -->
	    </div>
	</div>

<!-- Button trigger modal -->
<button id = "verify_recipient_button" type="button" class="btn btn-primary" data-toggle="modal" data-target="#verify_recipient">
  Send Email
</button>
    <hr>
</div>	

 <!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Form Upload Register</h4>
            </div>

            <div class="modal-body">
                <a href="<?php echo base_url('c_employee_details/download_template'); ?>" class="btn btn-warning my-1">Download Template</a>
                <hr>
                <?php
                    $input_file_data = array(
                        'type' => 'file',
                        'name' => 'file_upload',
                        'id' => 'file_upload',
                        'class' => 'form-control'
                    );

                    $submit_data = array(
                        'type' => 'submit',
                        'name' => 'submit',
                        'class' => 'btn btn-warning',
                        'value' => 'Upload'
                    );

                    echo form_open_multipart('c_employee_details/upload_register'); 
                
                    echo '<div class="form-group">';
                    echo form_input($input_file_data);
                    echo '</div>';
                    
                    echo '<div class="form-group">';
                    echo form_submit($submit_data);
                    echo '</div>';
                    
                    echo form_close(); 
                ?>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Verify Recipient Modal -->
<div class="modal fade" id="verify_recipient" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><span  class="label label-warning">Are you sure to send email to below users?<span></span></h4>
      </div>
      <div class="modal-body">
      <table class="table table-bordered" id="verify_email_data">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Employee Name</th>
                        <th>Department</th>
                        <th>Job Title</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>
            </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button id="send_button" type="button" class="btn btn-primary" data-dismiss="modal">Send</button>
      </div>
    </div>
  </div>
</div>

<script>
    $(document).ready(function(){
        const table = $('#registrationData').DataTable({
            // "deferRender": true,
                processing: true,
                serverSide: true,
                ajax: {
                    "url": "<?= base_url('c_employee_details/get_registration_data'); ?>",
                    "type": "POST"
                },
                "initComplete": function( setting, json) {
                    const send_button = document.getElementById('button_send');
                    const verify_recipient_button = document.getElementById('verify_recipient_button');
                    verify_recipient_button.addEventListener("click", function (){
                        const checkData = table.column(0).checkboxes.selected();
                        let arrData = [];
                        checkData.map(data => {
                            arrData.push(data);
                        });

                        $('#verify_email_data').DataTable({
                            destroy: true,
                            "deferRender": true,
                            "processing": true,
                            "serverSide": true,
                            "order": [],
                            ajax: {
                                "url": "<?= base_url('c_employee_details/verify_recipient/'); ?>",
                                "type": "POST",
                                "data": {data: arrData.join(',')}
                            },
                            "initComplete": function( setting, json) {
                                const send_button = document.getElementById('send_button');
                                send_button.addEventListener('click', function() {
                                $.post('<?= base_url('c_employee_details/send_email_employee_details')?>', {'postData[]': arrData})
                                    .done(function(data, status){
                                        window.alert(data);
                                        window.location = '<?= base_url('c_employee_details') ?>';
                                    });
                                }); 
                            },
                            "columnDefs": [{
                                "targets": [4],
                                "orderable": false
                            }]
                        });
                    });
                },
                columnDefs: [{
                    'targets': 0,
                    'checkboxes': {
                        'selectRow': true
                    }
                }],
                'select': {
                    'style': 'multi',
                },
                'order': [[2, 'desc']],
                columns: [
                    {
                        data: 0
                    },
                    {
                        data: 1
                    },
                    {
                        data: 2
                    },
                    {
                        data: 3
                    },
                    {
                        data: 4
                    },
                    {
                        data: 5
                    },
                    {
                        data: 6
                    },
                    {
                        data: 7
                    },
                    {
                        data: 8
                    },
                    {
                        data: 9,
                        render: function(data, type, full, meta) {
                            return `<a href="<?= base_url('c_employee_details/modify_copier_registration/') ?>${data}">
                                <i class="fa fa-edit fa-2x tooltips"></i>
                            </a>`;
                        }
                    }
                ],
        });
    });

    window.addEventListener('load', function(){
        // get data from ldap
			let xhr = new XMLHttpRequest();
			xhr.onreadystatechange = () => {
							if (xhr.readyState === 4) {
								if(xhr.status === 200) {
									console.log('ldap transfer to database success!');
								}
							}
						}
			xhr.open('get', '<?= base_url('c_employee_details/ldap_users')?>');
			xhr.send();
    });
</script>