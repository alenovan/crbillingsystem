<?php
$f_id = $f_id_user;
?>

<script>
// Variable berisi password saat ini dari PHP
function validateForm(event) {
  const newPassword = document.querySelector('input[name="new_password"]').value;
  const repeatNewPassword = document.querySelector('input[name="repeat_new_password"]').value;

  // Check apakah new_password sama dengan repeat_new_password
  if (newPassword !== repeatNewPassword) {
    alert("New password dan Repeat new password tidak cocok.");
    event.preventDefault(); // Mencegah form submit
    return false;
  }

  // Jika semua validasi lolos, form akan disubmit ke "?page=process&action=update-password"
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
        Reset Password
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
    <form method="POST" action="?page=process&action=update-password" onsubmit="return validateForm(event)">
    
    <!-- Stats -->
    <div class="section mt-2 mb-3">
        <div class="section-title">New Password</div>
        <div class="card">
            <div class="card-body">
                <div class="form-group boxed">
                    <div class="input-wrapper">
                        <label class="label" for="text4b">Input New Password</label>
                        <input type="password" class="form-control" id="text4b" placeholder="Input New Password" name="new_password">
                        <i class="clear-input">
                            <ion-icon name="close-circle" role="img" class="md hydrated" aria-label="close circle"></ion-icon>
                        </i>
                    </div>
                </div>
                <div class="form-group boxed">
                    <div class="input-wrapper">
                        <label class="label" for="text4b">Repeat New Password</label>
                        <input type="password" class="form-control" id="text4b" placeholder="Repeat New Password" name="repeat_new_password">
                        <i class="clear-input">
                            <ion-icon name="close-circle" role="img" class="md hydrated" aria-label="close circle"></ion-icon>
                        </i>
                    </div>
                </div>
            </div>
        </div>
        
        <input type="hidden" name="id" value="<?php echo $f_id; ?>" class="form-control mb-5 mt-5">
        
        <div class="form-button-group transparent">
            <button type="submit" class="btn btn-primary btn-block btn-lg">Reset Password</button>
        </div>
    </div>
    <!-- Stats -->

    </form>
</div>
<!-- * App Capsule -->
