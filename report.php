<?php
$QueryShowKasir = mysqli_query($mysqli, "SELECT * FROM users WHERE is_timer='1'");
?>

<style>
    .daterangepicker .ranges li{
        color: black !important;
    }
</style>

<!-- App Header -->
<div class="appHeader">
    <div class="left">
        <!--<a href="#" class="headerButton goBack">-->
        <!--    <ion-icon name="chevron-back-outline"></ion-icon>-->
        <!--</a>-->
    </div>
    <div class="pageTitle">
        Report
    </div>
</div>
<!-- * App Header -->

<!-- App Capsule -->
<div id="appCapsule" class="full-height">
<form action="<?php echo $baseurl; ?>all-report.php" method="POST">

    <div class="section mt-2">
            <div class="card">
                <div class="card-body pt-0">

                <ul class="nav nav-tabs lined" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#overview1" role="tab">
                                <ion-icon name="reorder-two" role="img" class="md hydrated" aria-label="wallet"></ion-icon>
                                Simple
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#overview2" role="tab">
                                <ion-icon name="options" role="img" class="md hydrated" aria-label="wallet"></ion-icon>
                                Advanced
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content mt-2">
                        <div class="tab-pane fade show active" id="overview1" role="tabpanel">
                            <div class="form-group boxed">
                                <div class="form-group boxed">
                                    <div class="input-wrapper mb-5">
                                        <label class="label" for="select4b">SELECT DATE</label>
                                        <div id="reportrange2" class="pull-right color-b mb-5" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                                            <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
                                            <span></span> <b class="caret color-b"></b>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="overview2" role="tabpanel">
                            <div class="form-group boxed">
                                <div class="input-wrapper mb-5">
                                    <label class="label" for="select4b">SELECT DATE</label>
                                    <div id="reportrange" class="pull-right color-b mb-5" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                                        <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
                                        <span></span> <b class="caret color-b"></b>
                                    </div>
                                    <input type="hidden" name="start_date" id="start_date">
                                    <input type="hidden" name="end_date" id="end_date">
                                </div>
                            </div>
                            <hr class="mt-5" />
                            <div class="form-group boxed">
                                <div class="input-wrapper">
                                    <label class="label" for="select4b">SELECT TYPE</label>
                                    <select class="form-control custom-select" id="select4b" name="type">
                                        <option value="" selected>All Type</option>
                                        <option value="OPEN-TABLE"> Open Table </option>
                                        <option value="OPEN-BILLING"> Open Billing </option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group boxed">
                                <div class="input-wrapper">
                                    <label class="label" for="select4b">SELECT STATUS</label>
                                    <select class="form-control custom-select" id="select4b" name="status">
                                        <option value="" selected>All Status</option>
                                        <option value="Done">Done</option>
                                        <option value="void">Void</option>
                                        <option value="no-order">No Order</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group boxed">
                                <div class="input-wrapper">
                                    <label class="label" for="select4b">SELECT CASHIER</label>
                                    <select class="form-control custom-select" id="select4b" name="cashier">
                                        <option value="" selected>All Cashier</option>
                                        <?php while($DataShowCashier = mysqli_fetch_array($QueryShowKasir)) { ?>
                                        <option value="<?php echo $DataShowCashier['id']; ?>"><?php echo titleCase($DataShowCashier['username']); ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <hr />
                            <div class="form-group boxed">
                                <div class="input-wrapper">
                                    <button type="reset" class="btn btn-secondary btn-block mb-1">RESET</button>
                                </div>
                            </div>
                        </div>
                    </div>

    
                    </div>
            </div>
    </div>
    <!-- Buttons -->
    <div class="section mt-3 mb-5">
        <div class="row">
            <div class="col">
                <button type="submit" class="btn btn-block btn-lg btn-primary">GENERATE</button>
            </div>
        </div>
    </div>
    <!-- Buttons -->

</form>
</div>
<!-- * App Capsule -->


<!-- External Scripts -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="<?php echo $baseurl; ?>public/assets/css/daterangepicker.css">
<script src="<?php echo $baseurl; ?>public/assets/js/jquery.min.js"></script>
<script src="<?php echo $baseurl; ?>public/assets/js/moment.min.js"></script>
<script src="<?php echo $baseurl; ?>public/assets/js/daterangepicker.min.js"></script>
<script type="text/javascript">
$(function() {

    var start = moment().subtract(29, 'days');
    var end = moment();

    function cb(start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        $('#start_date').val(start.format('YYYY-MM-DD'));
        $('#end_date').val(end.format('YYYY-MM-DD'));
    }

    $('#reportrange').daterangepicker({
        startDate: start,
        endDate: end,
        ranges: {
           'Today': [moment(), moment()],
           'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Last 7 Days': [moment().subtract(6, 'days'), moment()],
           'Last 30 Days': [moment().subtract(29, 'days'), moment()],
           'This Month': [moment().startOf('month'), moment().endOf('month')],
           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    }, cb);

    cb(start, end);
    
});

$(function() {

var start = moment().subtract(29, 'days');
var end = moment();

function cb(start, end) {
    $('#reportrange2 span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    $('#start_date').val(start.format('YYYY-MM-DD'));
    $('#end_date').val(end.format('YYYY-MM-DD'));
}

$('#reportrange2').daterangepicker({
    startDate: start,
    endDate: end,
    ranges: {
       'Today': [moment(), moment()],
       'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
       'Last 7 Days': [moment().subtract(6, 'days'), moment()],
       'Last 30 Days': [moment().subtract(29, 'days'), moment()],
       'This Month': [moment().startOf('month'), moment().endOf('month')],
       'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    }
}, cb);

cb(start, end);

});
</script>