<?php
$f_id = $f_id_user;
?>

<script>
// Variable berisi password saat ini dari PHP
function validateForm(event) {
  return true;
}
</script>

<!-- App Header -->
<div class="appHeader">
    <div class="left">
        <a href="#" class="headerButton goBack">
            <ion-icon name="chevron-back-outline"></ion-icon>
        </a>
    </div>
    <div class="pageTitle">
    Setting Price
    </div>
    <!-- <div class="right">
        <a href="#" class="headerButton" data-bs-toggle="modal" data-bs-target="#actionSheetShare">
            <ion-icon name="share-social-outline"></ion-icon>
        </a>
    </div> -->
</div>
<!-- * App Header -->


<!-- App Capsule -->
<div id="appCapsule" class="full-height">
    <form method="POST" action="?page=process&action=update-price" onsubmit="return validateForm(event)">
    
    <!-- Stats -->
    <div class="section mt-2 mb-3">
        <div class="section-title">Setting Price</div>
        <div class="card">
            <div class="card-body">
                <div class="form-group boxed">
                    <div class="input-wrapper">
                        <label class="label" for="text4b">Input Price (/ Minutes)</label>
                        <input type="number" class="form-control" id="price" placeholder="" name="price" value="<?= (int)$priceperminute;?>">
                        <i class="clear-input">
                            <ion-icon name="close-circle" role="img" class="md hydrated" aria-label="close circle"></ion-icon>
                        </i>
                    </div>
                </div>
            </div>
        </div>
        
        <input type="hidden" name="id" value="<?php echo $f_id; ?>" class="form-control mb-5 mt-5">
        
        <div class="form-button-group transparent">
            <button type="submit" class="btn btn-primary btn-block btn-lg">Setting Price</button>
        </div>
    </div>
    <!-- Stats -->

    </form>
</div>
<!-- * App Capsule -->
