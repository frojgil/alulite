<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>PF LOAN REPORT</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.5 -->
        <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body onload="window.print();" style="margin-left:70px">
        <div class="wrapper">
            <!-- Main content -->
            <section class="invoice">
                <!-- title row -->
                <div class="row">
                    <div class="col-xs-12">
                        <h6 class="page-header">
                            <i class="fa fa-book"></i> Rc.No GPF/F9/
                            <small class="pull-right">Date:&nbsp;&nbsp;<?php echo date("d-m-Y", strtotime("+5 hours 30 minutes")); ?></small>
                        </h6>
                    </div><!-- /.col -->
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <center><h5><u>PROCEEDINGS OF THE REGISTRAR, ALAGAPPA UNIVERSITY</u></h5><BR>

                            <p>Prof.V.Balachandran, Ph.D<br><span>REGISTRAR i/c.</span></p>
                        </center>
                        <p>Sub : GPF Temprorary Advance / Partfinal Withdrawal - Sanctioned - Reg</p>
                        <p>Ref: Vice-Chancellor's order Dated.</p>
                        <p style="text-align:justify">By direction of the Vice-Chancellor, sanction is hereby accorded under the relavant rule 
                            for the grant to temporary advance/ Partfinal Withdrawal from your GPF account subject to eligiblity as detailed below.</p><br><br>

                        <center><h5><u>LOAN SANCTION PERTICULARS FROM PF ACCOUNT</u></h5></center>
                        <div class="row">
                            <div class="col-xs-12">
                                <table style="width:100%" class="table">
                                    <tr>
                                        <td>Emp No&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo $_POST['empnotxt']; ?></td>
                                        <td>Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo strtoupper($_POST['empnametxt']); ?></td>
                                    </tr>
                                    <tr>
                                        <td>PF Ac.No&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo $_POST['pfacnotxt']; ?></td>
                                        <td>Date of Loan&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo date("d-m-Y", strtotime("+5 hours 30 minutes")); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Last Loan Date&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo date("d-m-Y", strtotime($_POST['lastloandatetxt'])); ?></td>
                                        <td>On Date Balancee&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo $_POST['ondatebaltxt']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Loan Balance&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo $_POST['lonbaltxt']; ?></td>
                                        <td>Loan Amount Payable&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo $_POST['aloantxt']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Consolidated Loan:&nbsp;&nbsp;<?php echo $_POST['newlonamtfinaltxt']; ?></td>
                                        <td>Monthly Dues&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo $_POST['emitxt']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>No of instalment&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo $_POST['noicmb']; ?></td>
                                        <td>Next dedection from the pay:&nbsp;&nbsp;<?php echo date("m/Y", strtotime("+5 hours 30 minutes")); ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <p>The copy of this proceedings may be enclosed while applying further Temprory Advance/ Partfinal withdrawal if any in future.</p><br><br>
                                <span class="pull-right"><p>REGISTRAR i/c<br><span>ALAGAPPA UNIVERSITY</span><br><span>KARAIKUDI</span></p></span>

                            </div>
                        </div>
                        <div class="row">
                            <br><br><br><br>
                            <div class="col-xs-12">
                                <span class="pull-left"><p>TO<br><span>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo strtoupper($_POST['empnametxt']); ?></span><br><span>&nbsp;&nbsp;&nbsp;&nbsp;ALAGAPPA UNIVERSITY</span><br><span>&nbsp;&nbsp;&nbsp;&nbsp;KARAIKUDI</span></span>
                            </div>
                        </div>
           
                        <div class="row">
                            <br><br><br><br><br><br><br><br><br><br>
                            <div class="col-xs-12">
                                <p>-----------------------------------------------------------&nbsp;<i class="fa fa-cut"></i>&nbsp;-----------------------------------------------------------</p>
                                <center><b>OFFICE COPY</b></center>
                            </div><!-- /.col -->
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <center><h5><u>LOAN SANCTION PERTICULARS FROM PF ACCOUNT</u></h5></center>
                        <div class="row">
                            <div class="col-xs-12">
                                <table style="width:100%" class="table">
                                    <tr>
                                        <td>Emp No&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo $_POST['empnotxt']; ?></td>
                                        <td>Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo strtoupper($_POST['empnametxt']); ?></td>
                                    </tr>
                                    <tr>
                                        <td>PF Ac.No&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo $_POST['pfacnotxt']; ?></td>
                                        <td>Date of Loan&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo date("d-m-Y", strtotime("+5 hours 30 minutes")); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Last Loan Date&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo date("d-m-Y", strtotime($_POST['lastloandatetxt'])); ?></td>
                                        <td>On Date Balancee&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo $_POST['ondatebaltxt']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Loan Balance&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo $_POST['lonbaltxt']; ?></td>
                                        <td>Loan Amount Payable&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo $_POST['aloantxt']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Consolidated Loan:&nbsp;&nbsp;<?php echo $_POST['newlonamtfinaltxt']; ?></td>
                                        <td>Monthly Dues&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo $_POST['emitxt']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>No of instalment&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo $_POST['noicmb']; ?></td>
                                        <td>Next dedection from the pay:&nbsp;&nbsp;<?php echo date("m/Y", strtotime("+5 hours 30 minutes")); ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                            </div>
                        </div>

                        </section><!-- /.content -->
                    </div><!-- ./wrapper -->

                    <!-- AluLTE App -->
                    <script src="../../dist/js/app.min.js"></script>
                    </body>
                    </html>
