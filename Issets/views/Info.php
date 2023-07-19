
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../issets/css/info.css" />
</head>
<body>
<div class="top">
    <button id="menu-btn">
        <span class="material-symbols-sharp" translate="no">menu</span>
    </button>
    <div class="theme-toggler">
        <span class="material-symbols-sharp active" translate="no">light_mode</span>
        <span class="material-symbols-sharp" translate="no">dark_mode</span>
    </div>
    <div class="profile">
        <div class="info">
            <p>Hola. <b><?=$_SESSION['Usuario']?></b></p>
            <small class="text-muted">Admin</small>
        </div>
    </div>
</div>
</body>
</html>