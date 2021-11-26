<div class="container box">
    <div class="row">
        <div class="col-lg-6">
            <h2>Modify Copier Registration</h2>
        </div>
    </div>
    <?php
        echo validation_errors();
    ?>

    <div class="row">
        <div class="col-lg-6">
            <?php 
                echo form_open(base_url('c_copier_registration/modify_copier_registration_action'));
                $disabled_employeeid_data = array(
                    'type' => 'text',
                    'name' => 'txt_employeeid',
                    'id' => 'txt_employeeid',
                    'class' => 'form-control',
                    'value'  => $copier_registration->fingerid,
                    'disabled' => 'disabled'
                );

                $disabled_employeename_data = array(
                    'type' => 'text',
                    'name' => 'txt_emplyeename',
                    'id' => 'txt_emplyeename',
                    'class' => 'form-control',
                    'value'  => $copier_registration->employeename,
                    'disabled' => 'disabled'
                );
                
                $disabled_employee_department_data = array(
                    'type' => 'text',
                    'name' => 'txt_department',
                    'id' => 'txt_department',
                    'class' => 'form-control',
                    'value'  => $copier_registration->deptdesc,
                    'disabled' => 'disabled'
                );
                
                $disabled_employee_position_data = array(
                    'type' => 'text',
                    'name' => 'txt_position',
                    'id' => 'txt_position',
                    'class' => 'form-control',
                    'value'  => $copier_registration->positiondesc,
                    'disabled' => 'disabled'
                );
                
                $disabled_employee_email_data = array(
                    'type' => 'text',
                    'name' => 'txt_email',
                    'id' => 'txt_email',
                    'class' => 'form-control',
                    'value'  => $copier_registration->email,
                    'disabled' => 'disabled'
                );

                $txt_other_password_data = array(
                    'type' => 'text',
                    'name' => 'txt_other_password',
                    'id' => 'txt_other_password',
                    'class' => 'form-control',
                    'value'  => $copier_registration->others_password,
                    'placeholder' => 'Other Password'
                );
            ?>
                <div class="form-group">
                    <label for="txt_employeeid">Employee ID: </label>
                    <?php echo form_input($disabled_employeeid_data); ?>
                </div>

                <div class="form-group">
                    <label for="txt_emplyeename">Employee Name: </label>
                    <?php echo form_input($disabled_employeename_data); ?>
                </div>

                <div class="form-group">
                    <label for="txt_department">Department: </label>
                    <?php echo form_input($disabled_employee_department_data); ?>
                </div>

                <div class="form-group">
                    <label for="txt_position">Position: </label>
                    <?php echo form_input($disabled_employee_position_data); ?>
                </div>

                <div class="form-group">
                    <label for="txt_email">Email: </label>
                    <?php echo form_input($disabled_employeeid_data); ?>
                </div>

                <div class="form-group">
                    <label for="txt_other_password">Other Password: </label>
                    <?php echo form_input($txt_other_password_data); ?>
                </div>
                <?= form_close(); ?>
        </div>
    </div>
</div>