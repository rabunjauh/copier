<style>
    table, th, td {
        border-collapse: collapse;
    }

    td {
        height: 30px;
        vertical-align: bottom;
    }

    th, td {
        padding: 5px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    .head {
        background-color: #3c84b4;
    }


    tr:nth-child(even) {background-color: #f2f2f2;}
</style>
<html>
    <span>Dear <?= $employeename ?></span>
    <p>Please use information below to access our systems</p>
    <br>
    <table>
        <tr class="head">
            <td>A</td>
            <td colspan="3"><strong>Employee Details</strong></td>
        </tr>
        <tr>
            <td>1</td>
            <td>ID Employee</td>
            <td>:</td>
            <td><?= $idemployee; ?></td>
        </tr>
        <tr>
            <td>2</td>
            <td>Name</td>
            <td>:</td>
            <td><?= $employeename; ?></td>
        </tr>
        <tr>
            <td>3</td>
            <td>Department</td>
            <td>:</td>
            <td><?= $deptdesc; ?></td>
        </tr>
        <tr>
            <td>4</td>
            <td>Position</td>
            <td>:</td>
            <td><?= $positiondesc; ?></td>
        </tr>
        <tr></tr>
        <tr class="head">
            <td>B</td>
            <td colspan="3">Email</td>
        </tr>
        <tr>
            <td>1</td>
            <td>Email Address / Username</td>
            <td>:</td>
            <td><?= $recipient; ?></td>
        </tr>
        <tr>
            <td>2</td>
            <td>Password</td>
            <td>:</td>
            <td>Password.1 <strong>(Capital P)</strong></td>
        </tr>
        <tr></tr>
        <tr class="head">
            <td>C</td>
            <td colspan="3">Desktop Login</td>
        </tr>
        <tr>
            <td>1</td>
            <td>Username</td>
            <td>:</td>
            <td><?= $username; ?></td>
        </tr>
        <tr>
            <td>2</td>
            <td>Password</td>
            <td>:</td>
            <td>Password.1 <strong>(Capital P)</strong></td>
        </tr>
        <tr></tr>
        <tr class="head">
            <td>D</td>
            <td colspan="3"><strong>Phone Extension</strong></td>
        </tr>
        <tr>
            <td></td>
            <td>Link</td>
            <td>:</td>
            <td><a href="http://192.168.40.12/phone">Phone Extension</a></td>
        </tr>
        <tr></tr>
        <tr class="head">
            <td>E</td>
            <td colspan="3"><strong>Skype</strong></td>
        </tr>
        <tr>
            <td></td>
            <td>Link</td>
            <td>:</td>
            <td><a href="https://signup.live.com/signup?lcid=1033&wa=wsignin1.0&rpsnv=13&ct=1606659234&rver=7.1.6819.0&wp=MBI_SSL&wreply=https%3a%2f%2flw.skype.com%2flogin%2foauth%2fproxy%3fclient_id%3d578134%26redirect_uri%3dhttps%253A%252F%252Fweb.skype.com%26source%3dscomnav%26form%3dmicrosoft_registration%26fl%3dphone2&lc=1033&id=293290&mkt=id-ID&psi=skype&lw=1&cobrandid=2befc4b5-19e3-46e8-8347-77317a16a5a5&client_flight=ReservedFlight33%2CReservedFligh&fl=phone2&lic=1&uaid=68450e498e9544f4b7f1923ace3e2a34">Skype Registration</a></td>
        </tr>
        <tr>
            <td></td>
            <td colspan="3">
                <i>
                    <?= "*Please use private email for the registration" ?>
                </i>
            </td>
        </tr>
        <tr></tr>
        <tr class="head">
            <td>F</td>
            <td colspan="3"><strong>Timesheet</strong></td>
        </tr>
        <tr>
            <td></td>
            <td colspan="3">Link</td>
        </tr>
        <tr>
            <td>1</td>
            <td>WEI Employee</td>
            <td>:</td>
            <td>
                <a href="192.168.40.80/hrms">Inside Office </a> /
                <a href="http://hrms.wascoenergy.com">Outside Office </a> 
            </td>
        </tr>
        <tr>
            <td>2</td>
            <td>WSEF Employee</td>
            <td>:</td>
            <td>
                <a href="https://hrsg.wascoenergy.com">WSEF Timesheet</a> 
            </td>
        </tr>
        <tr>
            <td></td>
            <td colspan="3">Login information</td>
        </tr>
        <tr>
            <td>1</td>
            <td>Username</td>
            <td>:</td>
            <td><?= $username; ?></td>
        </tr>
        <tr>
            <td>2</td>
            <td>Password</td>
            <td>:</td>
            <td>Password.1 <strong>(Capital P)</strong></td>
        </tr>
        <tr></tr>
        <tr class="head">
            <td>G</td>
            <td colspan="3"><strong>Printer Access</strong></td>
        </tr>
        <tr>
            <td>1</td>
            <td>Printer ID</td>
            <td>:</td>
            <td><?= $idemployee; ?></td>
        </tr>
        <tr>
            <td>2</td>
            <td>PIN / Password</td>
            <td>:</td>
            <td><?= $sharp_password; ?></td>
        </tr>
    </table>
    <p>
        <i>Note: This email is generated by system.
        for further communication please contact email below: <br> 
        Wahyu Maulana : wahyu.waulana@wascoenergy.com <br> 
        Ichwan Maulana : ichwan.maulana@wascoenergy.com   <br>   
        Mustafa : mustafa.m@wascoenergy.com
        </i>
    </p>
</html>
