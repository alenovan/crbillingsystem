<?php 

$pages = $_GET["page"];

// Mengatur kelas active sesuai dengan halaman yang dipilih
$activemenu = ''; // Menetapkan default value
if ($pages == 'dasbor') {
    $activemenu = 'active';
} else if ($pages == 'history') {
    $activemenu = 'active';
} else if ($pages == 'report') {
    $activemenu = 'active';
} else if ($pages == 'setting') {
    $activemenu = 'active';
} else {
    $activemenudefault = 'active';
}

?>

<!-- App Bottom Menu -->
<div class="appBottomMenu">
    <a href="?page=dasbor" class="item <?php if ($pages == 'dasbor') echo $activemenu; ?> <?php echo $activemenudefault; ?>">
        <div class="col">
            <ion-icon name="pie-chart-outline"></ion-icon>
            <strong>Dasbor</strong>
        </div>
    </a>
    <a href="?page=history" class="item <?php if ($pages == 'history') echo $activemenu; ?>">
        <div class="col">
            <ion-icon name="list-outline"></ion-icon>
            <strong>History</strong>
        </div>
    </a>
    <a href="?page=report" class="item <?php if ($pages == 'report') echo $activemenu; ?>">
        <div class="col">
            <ion-icon name="document-text-outline"></ion-icon>
            <strong>Report</strong>
        </div>
    </a>
    <a href="?page=setting" class="item <?php if ($pages == 'setting') echo $activemenu; ?>">
        <div class="col">
            <ion-icon name="settings-outline"></ion-icon>
            <strong>Settings</strong>
        </div>
    </a>
</div>
<!-- * App Bottom Menu -->
