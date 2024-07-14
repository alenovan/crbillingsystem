
    <!-- App Header -->
    <div class="appHeader">
        <div class="left">
            <a href="#" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">Add to Home</div>
        <div class="right"></div>
    </div>
    <!-- * App Header -->

    <!-- App Capsule -->
    <div id="appCapsule">

        <div class="section full mt-2">
            <div class="section-title">Preview</div>
            <ul class="listview image-listview inset">
                <li>
                    <a href="#" class="item" onclick="androidAddtoHome();">
                        <div class="icon-box bg-success">
                            <ion-icon name="logo-android"></ion-icon>
                        </div>
                        <div class="in">
                            <div>Android</div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#" class="item" onclick="iosAddtoHome();">
                        <div class="icon-box bg-secondary">
                            <ion-icon name="logo-apple"></ion-icon>
                        </div>
                        <div class="in">
                            <div>iOS</div>
                        </div>
                    </a>
                </li>
            </ul>
        </div>



        <!-- iOS Add to Home Action Sheet -->
        <div class="modal inset fade action-sheet ios-add-to-home" id="ios-add-to-home-screen" tabindex="-1"
            role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add to Home Screen</h5>
                        <a href="#" class="close-button" data-bs-dismiss="modal">
                            <ion-icon name="close"></ion-icon>
                        </a>
                    </div>
                    <div class="modal-body">
                        <div class="action-sheet-content text-center">
                            <div class="mb-1"><img src="public/assets/img/icon/192x192.png" alt="image"
                                    class="imaged w64 mb-2">
                            </div>
                            <div>
                                Install <strong>CR Billing System</strong> on your iPhone's home screen.
                            </div>
                            <div>
                                Tap <ion-icon name="share-outline"></ion-icon> and Add to homescreen.
                            </div>
                            <div class="mt-2">
                                <button class="btn btn-primary btn-block" data-bs-dismiss="modal">CLOSE</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- * iOS Add to Home Action Sheet -->


        <!-- Android Add to Home Action Sheet -->
        <div class="modal inset fade action-sheet android-add-to-home" id="android-add-to-home-screen" tabindex="-1"
            role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add to Home Screen</h5>
                        <a href="#" class="close-button" data-bs-dismiss="modal">
                            <ion-icon name="close"></ion-icon>
                        </a>
                    </div>
                    <div class="modal-body">
                        <div class="action-sheet-content text-center">
                            <div class="mb-1">
                                <img src="public/assets/img/icon/192x192.png" alt="image" class="imaged w64 mb-2">
                            </div>
                            <div>
                                Install <strong>CR Billing System</strong> on your Android's home screen.
                            </div>
                            <div>
                                Tap <ion-icon name="ellipsis-vertical"></ion-icon> and Add to homescreen.
                            </div>
                            <div class="mt-2">
                                <button class="btn btn-primary btn-block" data-bs-dismiss="modal">CLOSE</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- * Android Add to Home Action Sheet -->



    </div>
    <!-- * App Capsule -->