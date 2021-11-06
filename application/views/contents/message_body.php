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
            <td colspan="3"><span><strong>Employee Details</strong></span></td>
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
        <tr>
            <td>5</td>
            <td>Email Address</td>
            <td>:</td>
            <td><?= $recipient; ?></td>
        </tr>
        <tr>
            <td></td>
            <td>Password</td>
            <td>:</td>
            <td>password.1 <span><strong>(smallcaps)</strong></span></td>
        </tr>
        <tr>
            <td>6</td>
            <td>Desktop Login</td>
            <td>:</td>
            <td><?= strstr($recipient, '@', true); ?></td>
        </tr>
        <tr class="head">
            <td>B</td>
            <td colspan="3"><span><strong>Application System</strong></span></td>
        </tr>
        <tr>
            <td>1</td>
            <td>Phone Extension List</td>
            <td>:</td>
            <td><strong><a href="http://192.168.40.12/phone">Phone Extension List</a></strong></td>
        </tr>
        <tr class="head">
            <td></td>
            <td colspan="3"><span><strong>For Skype account, please register using WASCO email</strong></span></td>
        </tr>
        <tr>
            <td>2</td>
            <td>Skype Registration</td>
            <td>:</td>
            <td><strong><a href="https://signup.live.com/signup?lcid=1033&wa=wsignin1.0&rpsnv=13&ct=1606659234&rver=7.1.6819.0&wp=MBI_SSL&wreply=https%3a%2f%2flw.skype.com%2flogin%2foauth%2fproxy%3fclient_id%3d578134%26redirect_uri%3dhttps%253A%252F%252Fweb.skype.com%26source%3dscomnav%26form%3dmicrosoft_registration%26fl%3dphone2&lc=1033&id=293290&mkt=id-ID&psi=skype&lw=1&cobrandid=2befc4b5-19e3-46e8-8347-77317a16a5a5&client_flight=ReservedFlight33%2CReservedFligh&fl=phone2&lic=1&uaid=68450e498e9544f4b7f1923ace3e2a34">Skype Registration</a></strong></td>
        </tr>
        <tr>
            <td></td>
            <td>Skype Account</td>
            <td>:</td>
            <td><?= $recipient ?></td>
        </tr>
        <tr>
            <td>3</td>
            <td>Timesheet</td>
            <td>:</td>
            <td><strong><a href="http://192.168.40.80/hrms"> Inside Office </a> / <a href="http://hrms.wascoenergy.com">Outside Office </a></strong></td>
        </tr>
        <tr>
            <td></td>
            <td>Username</td>
            <td>:</td>
            <td><?= rtrim($recipient, "@gmail.com"); ?></td>
        </tr>
        <tr>
            <td></td>
            <td>Password</td>
            <td>:</td>
            <td>password.1</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td><strong><a href="\\192.168.40.58\MIS-Guide\Guide to Create Timesheet.pdf">Guide to Create Timesheet.pdf</strong></td>
        </tr>
        <tr class="head">
            <td>C</td>
            <td colspan="3"><span><strong>Printer Access</strong></span></td>
        </tr>
        <tr>
            <td>1</td>
            <td>Printer ID</td>
            <td>:</td>
            <td><?= $idemployee; ?></td>
        </tr>
        <tr>
            <td>2</td>
            <td>Printer</td>
            <td></td>
            <td>Password</td>
        </tr>
        <tr>
            <td></td>
            <td>Other Printer</td>
            <td>:</td>
            <td><?= $others_password; ?></td>
        </tr>
        <tr>
            <td></td>
            <td>Sharp Printer</td>
            <td>:</td>
            <td><?= $sharp_password; ?></td>
        </tr>
    </table>
</html>