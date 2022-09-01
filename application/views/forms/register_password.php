<div class="container box">
    <div class="row">
        <div class="col-lg-6">
            <h2>Register Password</h2>
        </div>
    </div>

    <?php 
        // $other_password_data = array(
        //     'type' => 'text',
        //     'name' => 'txt_others_password',
        //     'id' => 'txt_others_password',
        //     'class' => 'form-control',
        //     'placeholder' => 'Others Password'
        // );

        $sharp_password_data = array(
            'type' => 'text',
            'name' => 'txt_sharp_password',
            'id' => 'txt_sharp_password',
            'class' => 'form-control',
            'placeholder' => 'Sharp Password'
        );
        
        $is_client = array(
            'name' => 'client',
            'id' => 'client',
            'value' => '22',
            'checked' => false
        );

        $idemployee_data = array(
            'type' => 'text',
            'name' => 'txt_idemployee',
            'id' => 'txt_idemployee',
            'class' => 'form-control',
            'placeholder' => 'Employee ID'
        );

        $employee_name_data = array(
            'type' => 'text',
            'name' => 'txt_employee_name',
            'id' => 'txt_employee_name',
            'class' => 'form-control',
            'placeholder' => 'Employee Name'
        );

        // $employee_iddept_data = array(
        //     'type' => 'hidden',
        //     'name' => 'txt_employee_iddept',
        //     'id' => 'txt_employee_iddept',
        //     'class' => 'form-control',
        //     'placeholder' => 'Department'
        // );
        
        $employee_department_desc_data = array(
            'type' => 'text',
            'name' => 'txt_employee_department',
            'id' => 'txt_employee_department_desc',
            'class' => 'form-control',
            'placeholder' => 'Department'
        );
        
        // $employee_position_id_data = array(
        //     'type' => 'hidden',
        //     'name' => 'txt_employee_idposition',
        //     'id' => 'txt_employee_idposition',
        //     'class' => 'form-control',
        //     'placeholder' => 'Job Title'
        // );
        
        $employee_position_desc_data = array(
            'type' => 'text',
            'name' => 'txt_employee_positiondesc',
            'id' => 'txt_employee_positiondesc',
            'class' => 'form-control',
            'placeholder' => 'Job Title'
        );

        // $dept_options[0] = 'Department';
        // foreach($departments as $department) {
        //     $dept_options[$department->iddept] = $department->deptdesc;
        // }

        // $position_options[0] = 'Position';
        // foreach($positions as $position) {
        //     $position_options[$position->idposition] = $position->positiondesc;
        // }
        
        $employee_email_data = array(
            'type' => 'text',
            'name' => 'txt_employee_email',
            'id' => 'txt_employee_email',
            'class' => 'form-control',
            'placeholder' => 'Email'
        );

        $ldap_id_data = array(
            'type' => 'hidden',
            'name' => 'txt_ldap_id',
            'id' => 'txt_ldap_id',
        );
        
        $submit_data = array(
            'type' => 'submit',
            'name' => 'submit',
            'class'=> 'btn btn-primary',
            'value' => 'Register Employee Detail'
        );
        
        $reset = array(
            'name' => 'btn_reset',
            'class'=> 'btn btn-warning',
            'value' => 'Reset'
        );

        echo validation_errors(); 
        echo form_open(base_url('c_employee_details/register_password'));    
    ?>

    <div class="row">
        <div class="col-lg-4">
                <div class="form-group">
                <?php
                
                echo form_checkbox($is_client);
                echo form_label('Client / subcont ', $is_client['name']);
                ?>
                </div>

                <div class="form-group">
                
            <?php
                echo form_label('Employee ID: ', $idemployee_data['name']);
                echo form_input($ldap_id_data);
                echo form_input($idemployee_data);
            ?>
                </div>  

            <div class="form-group">
            <?php
                echo form_label('Name: ', $employee_name_data['name']);
            ?>

            <div class="input-group">
                <span class="input-group-btn">
                    <button type="button" id="search_employee" class="btn btn-danger" data-toggle="modal" data-backdrop="static" data-target="#search_ldap_users">
                        Search Employee
                    </button>
                </span>
                <?php
                    echo form_input($employee_name_data);
                ?>
            </div>
                </div>  

            
            
                <div class="form-group">
            <?php
                // echo form_label('Name: ', $employee_name_data['name']);
                // echo form_input($employee_name_data);
            ?>
                </div> 
                <div class="form-group">
            <?php
                echo form_label('Department: ', 'sel_dept');
                echo form_input($employee_department_desc_data);
                // echo form_input($employee_iddept_data);
                // echo form_dropdown('sel_dept', $dept_options, 'Department', 'id="sel_dept" class="form-control"');
            ?>
                </div>  
                
                <div class="form-group">
            <?php
                echo form_label('Position: ', 'sel_position');
                echo form_input($employee_position_desc_data);
                // echo form_dropdown('sel_position', $position_options, 'Position', 'id="sel_position" class="form-control"');
                // echo form_input($employee_position_id_data);
            ?>
                </div>  
                
                <div class="form-group">
            <?php
                echo form_label('Email: ', $employee_email_data['name']);
                echo form_input($employee_email_data);
            ?>
                </div> 
                
                <div class="form-group">
            <?php
                echo form_label('Sharp Password: ', $sharp_password_data['name']);
                echo form_input($sharp_password_data);
            ?>
                </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <?php
                    echo form_submit($submit_data);
                    echo form_reset($reset);
                ?>  
                <a href="<?= base_url('c_user'); ?>" class="btn btn-info">Back</a>
            </div> 
        </div>      
    </div>
        <?php
            echo form_close();
        ?>
</div>

<!-- Modal -->
<div class="modal fade bs-example-modal-lg" id="search_ldap_users" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Employee List</h4>
      </div>
      <div class="modal-body">
      <table class="table table-bordered hover" id="table_ldap_user_data">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID</th>
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
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>

<script>


    const txt_sharp_password = document.getElementById('txt_sharp_password');
    window.addEventListener('load', function() {
        const nameText =  document.getElementById('txt_employee_name');
        const emailText = document.getElementById('txt_employee_email');
        const departmentValue = document.getElementById('txt_employee_department_desc');
        const positionValue = document.getElementById('txt_employee_positiondesc');

        fieldArray = [departmentValue, positionValue, emailText];
        fieldArray.forEach(function (field) {
            field.disabled = true;
        });

        const client = document.getElementById('client');
        client.addEventListener('change', function() {
            if (this.checked) {
                document.getElementById('search_employee').disabled = true;
                document.getElementById('txt_idemployee').disabled = true;
                // txt_sharp_password.value = '';
            } else {
                document.getElementById('search_employee').disabled = false;
                document.getElementById('txt_idemployee').disabled = false;
                
                // getData('get_last_sharp_password', txt_sharp_password); 
           }
        });

        getData('get_last_sharp_password', txt_sharp_password); 

    });

    function getData(url, elementTarget) {
        let xhttp = new XMLHttpRequest();
        xhttp.open('GET', url, true);
        xhttp.onreadystatechange = function() {
            if(this.readyState == 4 && this.status == 200) {
                const prevPassword = this.responseText;
                if (prevPassword == '') {
                    elementTarget.value = '10001';
                } else {
                    intPrevPassword = parseInt(prevPassword);
                    passwordIncrement = intPrevPassword + 1;
                    nextPassword = (intPrevPassword + 1).toString();
                    elementTarget.value = nextPassword;
                }
            } 
        }
        xhttp.setRequestHeader('Content-Type',  'application/x-www-form-urlencoded');
        xhttp.send();
    }

    document.addEventListener('click', function(event) {
        if(event.target.parentElement.className === 'odd' || event.target.parentElement.className === 'even') {
            row = event.target.parentElement;
            const id = row.childNodes['1']
            const name = row.childNodes['2'];
            const department = row.childNodes['3'];
            const position = row.childNodes['4'];
            const email = row.childNodes['5'];

            const nameText =  document.getElementById('txt_employee_name');
            const emailText = document.getElementById('txt_employee_email');
            const ldap_id = document.getElementById('txt_ldap_id');
            const departmentValue = document.getElementById('txt_employee_department_desc');
            const positionValue = document.getElementById('txt_employee_positiondesc');

            ldap_id.value = id.textContent;
            nameText.value = name.textContent;
            departmentValue.value = department.textContent;
            positionValue.value = position.textContent;
            emailText.value = email.textContent;

            fieldArray = [nameText, departmentValue, positionValue, emailText];
            fieldArray.forEach(function (field) {
                field.disabled = true;
            });
        }
    })

    $(document).ready(function(){
        $('#table_ldap_user_data').DataTable({
                "createdRow": function(row, data, dataIndex) {
                    $(row).attr('data-dismiss', 'modal');
                },
                "deferRender": true,
                "processing": true,
                "serverSide": true,
                "order": [],
                ajax: {
                    "url": "<?= base_url('c_employee_details/get_ldap_users'); ?>",
                    "type": "POST"
                },
                "columnDefs": [{
                    "targets": [5],
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
                ]
        });
    });
</script>

