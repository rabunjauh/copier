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
                        <th>No</th>
                        <th>Employee ID</th>
                        <th>Sharp Password</th>
                        <th>Others Password</th>
                        <th>Employee Name</th>
                        <th>Department</th>
                        <th>Job Title</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>
            </table>
            <!-- <?php echo $this->pagination->create_links(); ?> -->
	    </div>
	</div>

    <div class="row">
        <div class="col-lg-12">
            <button id="button_send_email" name="button_send_email" class="btn btn-primary">Send Email</button>
        </div>
    </div>
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

<script>
    

    // confirmation(employeeSending);
    // confirmation(sharpSending);

    // function confirmation(elementTarget) {
    //     elementTarget.addEventListener('click', function(event) {
    //         event.preventDefault();
    //         console.log(elementTarget.href);
    //         if (confirm('Click ok to continue')) {
    //             window.location.replace(elementTarget.href);
    //         } else {
    //             event.preventDefault();
    //         }
    //     });
    // }

   
    $(document).ready(function(){
        $('#registrationData').DataTable({
            // "deferRender": true,
                "processing": true,
                "serverSide": true,
                "order": [],
                ajax: {
                    "url": "<?= base_url('c_employee_details/get_registration_data'); ?>",
                    "type": "POST"
                },
                "columnDefs": [{
                    "targets": [7],
                    "orderable": false
                }],
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
                        data: 8,
                        render: function(data, type, full, meta) {
                            const row_check = '<input type="checkbox" id="row" name="row" value="' + data + '">';
                            return row_check;
                            // return '<center?>' + sendEmployeeDetailBtn + '&nbsp;' +  sendPrinterDetailBtn + '&nbsp;' + modifyCopierRegisterBtn + ' </center>';
                        }
                    }
                ]
        });
    });

    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('fa-user')) {
           if (confirm('Send Employee Details?')) {
               window.location = '<?= base_url("c_employee_details/send_email_employee_details/") ?>' + e.target.dataset.registrationid;
           }
        }

        if (e.target.classList.contains('fa-print')) {
            if (confirm('Send Printer Details?')) {
                window.location = '<?= base_url("c_employee_details/send_email_sharp_details/") ?>' + e.target.dataset.registrationid;
            }
        }

        if (e.target.classList.contains('fa-edit')) {
            window.location = '<?= base_url("c_employee_details/modify_copier_registration/") ?>' + e.target.dataset.registrationid;
        }
        
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