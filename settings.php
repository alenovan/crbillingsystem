
    <!-- App Header -->
    <div class="appHeader">
        <div class="left">
            <!--<a href="#" class="headerButton goBack">-->
            <!--    <ion-icon name="chevron-back-outline"></ion-icon>-->
            <!--</a>-->
        </div>
        <div class="pageTitle">
            Settings
        </div>
    </div>
    <!-- * App Header -->

    <!-- App Capsule -->
    <div id="appCapsule">

        <div class="section mt-3 text-center">
            <div class="avatar-section">
                <a href="#">
                    <img src="<?php echo $baseurl; ?>public/assets/img/logo-profile.jpg" alt="avatar" class="imaged w100 rounded">
                </a>
            </div>
        </div>

        <div class="listview-title mt-1">Theme</div>
        <ul class="listview image-listview text inset inset">
            <li>
                <div class="item">
                    <div class="in">
                        <div>
                            Dark Mode
                        </div>
                        <div class="form-check form-switch  ms-2">
                            <input class="form-check-input dark-mode-switch" type="checkbox" id="darkmodeSwitch">
                            <label class="form-check-label" for="darkmodeSwitch"></label>
                        </div>
                    </div>
                </div>
            </li>
            <li>
                <a href="detail-page.php?page=add-to-home" class="item">
                    <div class="in">
                        <div>Install Apps</div>
                    </div>
                </a>
            </li>
            <li>
                <a href="<?php echo $baseurl; ?>apk/aplikasi.apk" target="_blank" class="item">
                    <div class="in">
                        <div>Install Cashier APK</div>
                    </div>
                </a>
            </li>
        </ul>

        <div class="listview-title mt-1">Security</div>
        <ul class="listview image-listview text mb-2 inset">
            <li>
                <a href="pages.php?page=reset-password" class="item">
                    <div class="in">
                        <div>Reset Password</div>
                    </div>
                </a>
            </li>
            <li>
                <div class="item">
                    <div class="in">
                        <div>
                            Remember Account
                        </div>
                        <div class="form-check form-switch ms-2">
                            <input class="form-check-input" type="checkbox" id="SwitchCheckDefault3" checked />
                            <label class="form-check-label" for="SwitchCheckDefault3"></label>
                        </div>
                    </div>
                </div>
            </li>
            <li>
                <a href="<?php echo $baseurl; ?>?logout" class="item">
                    <div class="in">
                        <div>Log out all devices</div>
                    </div>
                </a>
            </li>
        </ul>


    </div>
    <!-- * App Capsule -->