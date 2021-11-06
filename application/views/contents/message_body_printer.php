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
    <p>Please use information below to access our printers</p>
    <br>
    <table>
        <tr class="head">
            <td>A</td>
            <td colspan="3"><span><strong>Sharp Printer Details</strong></span></td>
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
        <tr class="head">
            <td>C</td>
            <td colspan="3"><span><strong>Print & Scan Guide</strong></span></td>
        </tr>
        <tr>
            <td>1</td>
            <td colspan="3"><a href="\\192.168.40.58\MIS-Guide\Guide - Input Password Printer Sharp.pdf">Guide - Input Password Printer Sharp</a></span></td>
        </tr>
        <tr>
            <td>2</td>
            <td colspan="3"><a href="\\192.168.40.58\MIS-Guide\Guide - Scan Doc - Machine Printer Sharp.pdf">Guide - Scan Doc - Machine Printer Sharp</a></td>
        </tr>
    </table>
</html>