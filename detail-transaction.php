<?php
$id=$_GET['id'];
$QueryShowDetail = mysqli_query($mysqli, "
    SELECT 
        orders.*,
        users.username AS cashier
    FROM 
        orders
    INNER JOIN 
        users 
    ON 
        orders.id_users = users.id
    WHERE
        orders.id=$id");
        
$DataDetail = mysqli_fetch_array($QueryShowDetail);
?>
<!-- App Header -->
<div class="appHeader">
    <div class="left">
        <a href="#" class="headerButton goBack">
            <ion-icon name="chevron-back-outline"></ion-icon>
        </a>
    </div>
    <div class="pageTitle">
        Transaction Detail
    </div>
    <!-- <div class="right">
        <a href="#" class="headerButton" data-bs-toggle="modal" data-bs-target="#actionSheetShare">
            <ion-icon name="share-social-outline"></ion-icon>
        </a>
    </div> -->
</div>
<!-- * App Header -->

<!-- Update Action Sheet -->
<div class="modal fade action-sheet" id="updateActionSheet" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Transaction</h5>
            </div>
            <div class="modal-body">
                <div class="action-sheet-content">
                    <form method="POST" action="?page=process&action=update-transaction">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <div class="form-group basic">
                            <div class="input-wrapper">
                                <label class="label" for="account1">Type</label>
                                <select name="status_data" class="form-control custom-select" id="account1">
                                    <option value="Done">Done</option>
                                    <option value="void">Void</option>
                                    <option value="no-order">No Order</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group basic">
                            <label class="label">Enter Reason</label>
                            <div class="input-group mb-2">
                                <input type="text" name="notes" class="form-control" placeholder="Enter reason" Required>
                            </div>
                        </div>

                        <div class="form-group basic">
                            <button type="submit" class="btn btn-primary btn-block btn-lg">Update</button>
                        </div>
                    </form>
                </div>
            </div>  
        </div>
    </div>
</div>
<!-- * Update Action Sheet -->

<!-- Share Action Sheet -->
<div class="modal fade action-sheet inset" id="actionSheetShare" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Share to</h5>
            </div>
            <div class="modal-body">
                <ul class="action-button-list">
                    <li>
                        <a href="#" class="btn btn-list" data-bs-dismiss="modal">
                            <span>
                                <ion-icon name="logo-whatsapp"></ion-icon>
                                WhatsApp
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="btn btn-list" data-bs-dismiss="modal">
                            <span>
                                <ion-icon name="document"></ion-icon>
                                Export PDF
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- * Share Action Sheet -->

<!-- App Capsule -->
<div id="appCapsule" class="full-height">

    <!-- Stats -->
    <div class="section mt-2 mb-3">
        <div class="card">
            <ul class="listview no-line transparent flush simple-listview">
                <li>
                    <div class="text-muted">No. Transaction</div>
                    <strong class="text-primary">#<?php echo $f_client_id; ?><?php echo $DataDetail['id']; ?></strong>
                </li>
                <li>
                    <div class="text-muted">Date</div>
                    <strong><?php echo tgl_indo(date('Y-m-d', strtotime($DataDetail['created_at']))); ?></strong>
                </li>
                <li>
                    <div class="text-muted">Table No.</div>
                    <strong>Table <?php echo $DataDetail['id_rooms']; ?></strong>
                </li>
                <li>
                    <div class="text-muted">Cust. Name</div>
                    <strong><?php echo titleCase($DataDetail['name']); ?></strong>
                </li>
                <li>
                    <div class="text-muted">Phone Number</div>
                    <strong><a href="tel:<?php echo $DataDetail['phone']; ?>"><?php echo $DataDetail['phone']; ?></a></strong>
                </li>
                <?php if($DataDetail['status_data']==''){ ?>
                <li>
                    <div class="text-muted">Status</div>
                    <strong class="text-success">ON GOING</strong>
                </li>
                <?php }else{ ?>
                <li>
                    <div class="text-muted">Status</div>
                    <?php if($DataDetail['status_data']=='Done'){ ?>
                        <strong class="text-success">DONE</strong>
                    <?php }else if($DataDetail['status_data']=='void'){ ?>
                        <strong class="text-danger">VOID</strong>
                    <?php }else { ?>
                        <strong class="text-warning">NO ORDER</strong>
                    <?php } ?>
                </li>
                <?php } ?>
            </ul>
        </div>
    </div>
    <!-- Stats -->

    <!-- Stats -->
    <div class="section mt-2 mb-3">
        <div class="card">
            <ul class="listview no-line transparent flush simple-listview">
                <li>
                    <div class="text-muted">Order Type</div>
                    <strong><?php echo $DataDetail['type']; ?></strong>
                </li>
                <li>
                    <div class="text-muted">Start</div>
                    <strong><?php echo tgl_indo(date('Y-m-d', strtotime($DataDetail['start_time']))); ?> - <?php echo date('H:i', strtotime($DataDetail['start_time'])); ?></strong>
                </li>
                <li>
                    <div class="text-muted">End</div>
                    <?php if($DataDetail['status']=='STOP'){ ?>
                        <strong><?php echo tgl_indo(date('Y-m-d', strtotime($DataDetail['end_time']))); ?> - <?php echo date('H:i', strtotime($DataDetail['end_time'])); ?></strong>
                    <?php }else{ ?>
                        <strong>-</strong>
                    <?php } ?>
                </li>
                <li>
                    <div class="text-muted">Duration</div>
                    <strong>
                        <?php
                        // Data yang diberikan
                        $start = $DataDetail['start_time'];
                        $end = $DataDetail['end_time'];
                        
                        echo calculateTimeDifference($start, $end);
                        ?>
                    </strong>
                </li>
                <li>
                    <div class="text-muted">Cashier</div>
                    <strong><?php echo titleCase($DataDetail['cashier']); ?></strong>
                </li>
            </ul>
        </div>
    </div>
    <!-- Stats -->

    <?php if($DataDetail['notes']==''){ ?>
    <?php }else{ ?>
    <!-- Stats -->
    <div class="section mt-2 mb-3">
        <div class="card">
            <ul class="listview no-line transparent flush simple-listview">
                <li>
                    <div class="text-muted">Notes / Reason</div>
                    <strong><?php echo $DataDetail['notes']; ?></strong>
                </li>
            </ul>
        </div>
    </div>
    <!-- Stats -->
    <?php } ?>

     <?php if($DataDetail['status']=='STOP'){ ?>
    <!-- Buttons -->
    <div class="section">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <a href="#" class="button btn btn-block btn-lg btn-danger" data-bs-toggle="modal" data-bs-target="#updateActionSheet">UPDATE</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Buttons -->
    <?php }else{} ?>
</div>
<!-- * App Capsule -->
