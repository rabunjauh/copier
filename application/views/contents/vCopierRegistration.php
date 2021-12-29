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
	<br>
	<div class="row">
		<div class="col-lg-12">
            <table class="table table-bordered" id="registrationData">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Employee ID</th>
                        <th>Sharp Password</th>
                        <th>Other Password</th>
                        <th>Name</th>
                        <th>Department</th>
                        <th>Job Title</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                            $no = 1;
                            foreach ($copier_registrations as $copier_registration): 
                    ?>
                                <tr>
                                    <td><?php echo $no; ?></td>
                                    <td><?php echo $copier_registration->idemployee; ?></td>
                                    <td><?php echo $copier_registration->sharp_password; ?></td>
                                    <td><?php echo $copier_registration->others_password; ?></td>
                                    <td><?php echo $copier_registration->employeename; ?></td>
                                    <td><?php echo $copier_registration->deptdesc; ?></td>
                                    <td><?php echo $copier_registration->positiondesc; ?></td>
                                    <td><?php echo $copier_registration->email; ?></td>
                                    <td>
                                        <a id="employeeSending" href="<?= base_url('c_employee_details/send_email_employee_details/' . $copier_registration->id); ?>"><i class="fa fa-user fa-2x"></i></a>
                                        <a id="sharpSending" href="<?= base_url('c_employee_details/send_email_sharp_details/' . $copier_registration->id); ?>"><i class="fa fa-print fa-2x"></i></a>
                                        <a href="<?= base_url('c_employee_details/modify_copier_registration/' . $copier_registration->id); ?>"><i class="fa fa-edit fa-2x"></i></a>
                                    </td>
                                </tr>
                                </form>
                    <?php   
                                
                            $no++;   
                            endforeach;
                    ?>
                </tbody>
            </table>
            <!-- <?php echo $this->pagination->create_links(); ?> -->
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
    const employeeSending = document.getElementById('employeeSending');
    const sharpSending = document.getElementById('sharpSending');

    confirmation(employeeSending);
    confirmation(sharpSending);

    function confirmation(elementTarget) {
        elementTarget.addEventListener('click', function(event) {
            if (confirm('Click ok to continue')) {
                return true;
            } else {
                event.preventDefault();
            }
        });
    }
    
    $(document).ready(function(){
        $('#registrationData').DataTable();
    });
</script>