<div class="container box">
    <div class="row">
        <div class="col-lg-6">
            <h2>Register Password</h2>
        </div>
    </div>

    <?php 
        // $sharp_password_data = array(
        //     'type' => 'text',
        //     'name' => 'txt_sharp_password',
        //     'id' => 'txt_sharp_password',
        //     'class' => 'form-control'
        // );
        
        $other_password_data = array(
            'type' => 'text',
            'name' => 'txt_others_password',
            'id' => 'txt_others_password',
            'class' => 'form-control',
            'placeholder' => 'Others Password'
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
        
        // $employee_department_desc_data = array(
        //     'type' => 'text',
        //     'name' => 'txt_employee_department',
        //     'id' => 'txt_employee_department_desc',
        //     'class' => 'form-control',
        //     'placeholder' => 'Department'
        // );
        
        // $employee_position_id_data = array(
        //     'type' => 'hidden',
        //     'name' => 'txt_employee_idposition',
        //     'id' => 'txt_employee_idposition',
        //     'class' => 'form-control',
        //     'placeholder' => 'Job Title'
        // );
        
        // $employee_position_desc_data = array(
        //     'type' => 'text',
        //     'name' => 'txt_employee_positiondesc',
        //     'id' => 'txt_employee_positiondesc',
        //     'class' => 'form-control',
        //     'placeholder' => 'Job Title'
        // );

        $dept_options[0] = 'Department';
        foreach($departments as $department) {
            $dept_options[$department->iddept] = $department->deptdesc;
        }

        $position_options[0] = 'Position';
        foreach($positions as $position) {
            $position_options[$position->idposition] = $position->positiondesc;
        }
        
        $employee_email_data = array(
            'type' => 'text',
            'name' => 'txt_employee_email',
            'id' => 'txt_employee_email',
            'class' => 'form-control',
            'placeholder' => 'Email'
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
        <div class="col-lg-6">
                <div class="form-group">
            <?php
                echo form_label('Other Password: ', $other_password_data['name']);
                echo form_input($other_password_data);
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
                echo form_label('Name: ', $employee_name_data['name']);
                echo form_input($employee_name_data);
            ?>
                </div>  
        </div>

        <div class="col-lg-6">
                <div class="form-group">
            <?php
                echo form_label('Department: ', 'sel_dept');
                echo form_dropdown('sel_dept', $dept_options, 'Department', 'id="sel_dept" class="form-control"');
                // echo form_input($employee_iddept_data);
                // echo form_input($employee_department_desc_data);
            ?>
                </div>  
                
                <div class="form-group">
            <?php
                echo form_label('Position: ', 'sel_position');
                echo form_dropdown('sel_position', $position_options, 'Position', 'id="sel_position" class="form-control"');
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
                    echo form_reset($reset);
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

