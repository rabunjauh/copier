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

        $idemployee_data = array(
            'type' => 'text',
            'name' => 'txt_employeeid',
            'id' => 'txt_employeeid',
            'class' => 'form-control',
            'value'  => $copier_registration->idemployee
        );

        $employeename_data = array(
            'type' => 'text',
            'name' => 'txt_employeename',
            'id' => 'txt_employeename',
            'class' => 'form-control',
            'value'  => $copier_registration->employeename
        );
        
        // $employee_department_data = array(
        //     'type' => 'text',
        //     'name' => 'txt_department',
        //     'id' => 'txt_department',
        //     'class' => 'form-control',
        //     'value'  => $copier_registration->deptdesc
        // );
        
        // $employee_position_data = array(
        //     'type' => 'text',
        //     'name' => 'txt_position',
        //     'id' => 'txt_position',
        //     'class' => 'form-control',
        //     'value'  => $copier_registration->positiondesc
        // );

        // $dept_options[0] = 'Department';
        foreach($departments as $department) {
            $dept_options[$department->iddept] = $department->deptdesc;
        }

        // $position_options[0] = 'Position';
        foreach($positions as $position) {
            $position_options[$position->idposition] = $position->positiondesc;
        }

        $employee_email_data = array(
            'type' => 'text',
            'name' => 'txt_email',
            'id' => 'txt_email',
            'class' => 'form-control',
            'value'  => $copier_registration->email
        );

        
        $copier_id = array(
            'type' => 'hidden',
            'name' => 'copier_id',
            'id' => 'copier_id',
            'class' => 'form-control',
            'value'  => $copier_registration->id
            // 'disabled' => 'disabled'
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
        <div class="col-lg-6">
                <div class="form-group">
            <?php         
                    echo form_label('Other Password: ', $txt_other_password_data['name']);
                    echo form_input($txt_other_password_data); 
            ?>
                </div>
                
                <div class="form-group">
            <?php 
                    echo form_label('Employee ID: ', $idemployee_data['name']);
                    echo form_input($idemployee_data); 
            ?>
                </div>

                <div class="form-group">
            <?php 
                    echo form_label('Name: ', $employeename_data['name']);
                    echo form_input($employeename_data); 
            ?>
                </div>
        </div>

        <div class="col-lg-6">
                <div class="form-group">
            <?php
                echo form_label('Department: ', 'sel_dept');
                echo form_dropdown('sel_dept', $dept_options, $copier_registration->iddept, 'id="sel_dept" class="form-control"');
                // echo form_input($employee_iddept_data);
                // echo form_input($employee_department_desc_data);
            ?>
                </div>  
                
                <div class="form-group">
            <?php
                echo form_label('Position: ', 'sel_position');
                echo form_dropdown('sel_position', $position_options, $copier_registration->idposition, 'id="sel_position" class="form-control"');
                // echo form_input($employee_position_id_data);
                // echo form_input($employee_position_desc_data);
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

<script>
    const btnSearchEmployee = document.getElementById('btnSearchEmployee');
    // btnSearchEmployee.addEventListener('click', function() {
    //     window.open('<?= base_url('c_employee/get_employee_data') ?>', 'popuppage', 'width=700, location=0, toolbar=0, menubar=0, resizable=1, scrollbars=0, height=500, top=100, left=100')
    // });

    const sel_dept = document.getElementById('sel_dept');
    const sel_position = document.getElementById('sel_position');

    sel_dept.addEventListener('change', function(e) {
        const sel_dept_value = this.value;
        const url = '<?= base_url('c_employee/department_position_dependent'); ?>';
        dependentSelect("iddept="+sel_dept_value, url, sel_position);
    });

    function dependentSelect(input, url, elementTarget) {
        let xhttp = new XMLHttpRequest();
        xhttp.open('POST', url, true);
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                let output = JSON.parse(this.responseText);
                elementTarget.innerHTML = output;
            }
        }
        xhttp.setRequestHeader('Content-Type',  'application/x-www-form-urlencoded');
        xhttp.send(input);
    }
</script>