<div class="container box">
    <div class="row">
        <div class="col-lg-6">
            <h2>Modify Copier Registration</h2>
        </div>
    </div>

    <?php 
        $txt_other_password_data = array(
            'type' => 'text',
            'name' => 'txt_other_password',
            'id' => 'txt_other_password',
            'class' => 'form-control',
            'value'  => $copier_registration->others_password,
            'placeholder' => 'Other Password'
        );
       
        $txt_sharp_password_data = array(
            'type' => 'text',
            'name' => 'txt_sharp_password',
            'id' => 'txt_sharp_password',
            'class' => 'form-control',
            'value'  => $copier_registration->sharp_password,
            'placeholder' => 'Other Password'
        );

        $idemployee_data = array(
            'type' => 'text',
            'name' => 'txt_employeeid',
            'id' => 'txt_employeeid',
            'class' => 'form-control',
            'value'  => $copier_registration->idemployee
        );

        // $employeename = ($copier_registration->ldap_id === null ) ? $copier_registration->employeename : $copier_registration->name;
        $employeename_data = array(
            'type' => 'text',
            'name' => 'txt_employeename',
            'id' => 'txt_employeename',
            'class' => 'form-control',
            // 'value'  => $employeename
            'value'  => ($copier_registration->ldap_id === null ) ? $copier_registration->employeename : $copier_registration->name
        );
        
        $employee_department_data = array(
            'type' => 'text',
            'name' => 'txt_department',
            'id' => 'txt_department',
            'class' => 'form-control',
            'value'  => ($copier_registration->ldap_id === null ) ? $copier_registration->deptdesc : $copier_registration->department
        );
        
        $employee_position_data = array(
            'type' => 'text',
            'name' => 'txt_position',
            'id' => 'txt_position',
            'class' => 'form-control',
            'value'  => ($copier_registration->ldap_id === null ) ? $copier_registration->positiondesc : $copier_registration->position
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
            'name' => 'txt_email',
            'id' => 'txt_email',
            'class' => 'form-control',
            'value'  => ($copier_registration->ldap_id === null) ? $copier_registration->email : $copier_registration->ldap_email
        );

        
        $copier_id = array(
            'type' => 'hidden',
            'name' => 'copier_id',
            'id' => 'copier_id',
            'class' => 'form-control',
            'value'  => $copier_registration->id
            // 'disabled' => 'disabled'
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
            'value' => 'Update Employee Detail'
        );
        
        echo validation_errors();
        echo form_open(base_url('c_employee_details/update_copier_registration'));
        echo form_input($copier_id);
    ?>

    <div class="row">
        <div class="col-lg-4">
        <h4>Password Information</h4>
        <hr>
                <div class="form-group">
            <?php
                echo form_label('Sharp Password: ', $txt_sharp_password_data['name']);
                echo form_input($txt_sharp_password_data);
            ?>
                </div> 
                
                <div class="form-group">
            <?php         
                    echo form_label('Other Password: ', $txt_other_password_data['name']);
                    echo form_input($txt_other_password_data); 
            ?>
                </div>   
        </div>

        <div class="col-lg-4">
            <h4>Employee Information</h4>
            <hr>
                <div class="form-group">
            <?php 
                    echo form_label('Employee ID: ', $idemployee_data['name']);
                    echo form_input($idemployee_data); 
            ?>
                </div>

                <div class="form-group">
                    <?php
                        echo form_label('Name: ', $employeename_data['name']);
                    ?>
                
                    <div class="input-group">
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-backdrop="static" data-target="#search_ldap_users">
                                Search Employee
                            </button>
                        </span>
            <?php 
                    echo form_input($ldap_id_data);
                    echo form_input($employeename_data); 
            ?>
                    </div>
                </div>

                <div class="form-group">
            <?php
                echo form_label('Department: ', 'sel_dept');
                echo form_input($employee_department_data); 
                // echo form_dropdown('sel_dept', $dept_options, 7, 'id="sel_dept" class="form-control"');
                // echo form_dropdown('sel_dept', $dept_options, $copier_registration->iddept, 'id="sel_dept" class="form-control"');
            ?>
                </div>  
                
                <div class="form-group">
            <?php
                echo form_label('Position: ', 'sel_position');
                echo form_input($employee_position_data); 
                // echo form_dropdown('sel_position', $position_options, $copier_registration->idposition, 'id="sel_position" class="form-control"');
            ?>
                </div>  
                
                <div class="form-group">
            <?php
                echo form_label('Email: ', $employee_email_data['name']);
                echo form_input($employee_email_data);
            ?>
                </div> 
        </div>     
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <?php
                    echo form_submit($submit_data);
                ?>  
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
    $(document).ready(function(){
        window.addEventListener('load', function() {
            const nameText =  document.getElementById('txt_email');
            const emailText = document.getElementById('txt_email');
            fieldArray = [nameText, txt_department, txt_position, emailText];
                fieldArray.forEach(function (field) {
                    field.disabled = true;
                });
        });

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

    document.addEventListener('click', function(event) {
            if(event.target.parentElement.className === 'odd' || event.target.parentElement.className === 'even') {
                row = event.target.parentElement;
                const id = row.childNodes['1']
                const name = row.childNodes['2'];
                const department = row.childNodes['3'];
                const position = row.childNodes['4'];
                const email = row.childNodes['5'];

                const nameText =  document.getElementById('txt_email');
                const emailText = document.getElementById('txt_email');
                const ldap_id = document.getElementById('txt_ldap_id');
                const departmentValue = document.getElementById('txt_department');
                const positionValue = document.getElementById('txt_position');

                ldap_id.value = id.textContent;
                nameText.value = name.textContent;
                departmentValue.value = department.textContent;
                positionValue.value = position.textContent;
                emailText.value = email.textContent;

                fieldArray = [nameText, txt_department, sel_position, emailText];
                fieldArray.forEach(function (field) {
                    field.disabled = true;
                });
            }
        })

    const btnSearchEmployee = document.getElementById('btnSearchEmployee');
    // btnSearchEmployee.addEventListener('click', function() {
    //     window.open('<?= base_url('c_employee/get_employee_data') ?>', 'popuppage', 'width=700, location=0, toolbar=0, menubar=0, resizable=1, scrollbars=0, height=500, top=100, left=100')
    // });

    // const sel_dept = document.getElementById('sel_dept');
    // const sel_position = document.getElementById('sel_position');

    // sel_dept.addEventListener('change', function(e) {
    //     const sel_dept_value = this.value;
    //     const url = '<?= base_url('c_employee/department_position_dependent'); ?>';
    //     dependentSelect("iddept="+sel_dept_value, url, sel_position);
    // });

    const txt_sharp_password = document.getElementById('txt_sharp_password');
    const txt_others_password = document.getElementById('txt_other_password');

    txt_sharp_password.addEventListener('keyup', function() {
        if (this.value === '') {
            txt_others_password.value = '';    
        } else {
            txt_others_password.value = this.value.substring(1);
        }
    });

    // function dependentSelect(input, url, elementTarget) {
    //     let xhttp = new XMLHttpRequest();
    //     xhttp.open('POST', url, true);
    //     xhttp.onreadystatechange = function() {
    //         if (this.readyState == 4 && this.status == 200) {
    //             let output = JSON.parse(this.responseText);
    //             elementTarget.innerHTML = output;
    //         }
    //     }
    //     xhttp.setRequestHeader('Content-Type',  'application/x-www-form-urlencoded');
    //     xhttp.send(input);
    // }
</script>