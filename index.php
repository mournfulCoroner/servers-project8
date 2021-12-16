<?php
    include 'login.php';
    include 'constants.php';
    include '../../db/theatreRepository.php';

    $dictionary = $DICTIONARY[$_SESSION['language']];
?>

<html lang="<?php echo $_SESSION['language'] ?>">

<head>
    <title><?php echo $dictionary->ADMIN_PANEL ?></title>
    <link rel="icon" href="/img/mask_icon.svg" type="image/svg+xml">
    <link rel="stylesheet" href="/style_admin.css">
    <link rel="stylesheet" href="/admin.css">
    <?php 
        if ($_SESSION['theme'] == THEME::$DARK) {
            echo '<link rel="stylesheet" href="/dark-theme.css">';
        }
    ?>
</head>

<body>
    <div class="admin-panel">
    <h1><?php echo $dictionary->ADMIN_PANEL ?></h1>

    <div class="name">
        <?php
            echo $dictionary->HI . ", " . ($_SESSION['name'] ?: $dictionary->NAMELESS) . "!";
        ?>
    </div>

    <h2><?php echo $dictionary->SETTING ?></h2>
    <form action="/admin/setting.php" method="post" class="auth-form">
        <div>
            <?php echo $dictionary->THEME ?>: <br>
            <label>
                <input type="radio" name="theme" 
                    <?php 
                        if ($_SESSION['theme'] == THEME::$LIGHT) {
                            echo "checked";
                        }
                    ?>
                    value="light"
                >
                <?php echo $dictionary->LIGHT ?>
            </label>
            <label>
                <input type="radio" name="theme" 
                    <?php 
                        if ($_SESSION['theme'] == THEME::$DARK) {
                            echo "checked";
                        }
                    ?>
                    value="dark"
                >
                <?php echo $dictionary->DARK ?>
            </label>
        </div>

        <div>
            <?php echo $dictionary->LANGUAGE ?>: <br>
            <label>
                <input type="radio" name="language"
                    <?php 
                        if ($_SESSION['language'] == LANGUAGE::$RU) {
                            echo "checked";
                        }
                    ?>
                    value="ru"
                >
                Русский
            </label>
            <label>
                <input type="radio" name="language"
                    <?php 
                        if ($_SESSION['language'] == LANGUAGE::$EN) {
                            echo "checked";
                        }
                    ?>
                    value="en"
                >
                English
            </label>
        </div>

        <div>
            <label>
                <?php echo $dictionary->NAME ?>:
                <input type="text" name="name">
            </label>
        </div>

        <button type="submit"><?php echo $dictionary->UPDATE ?></button>
    </form>

    <h2>PDF</h2>
    <form enctype="multipart/form-data" action="/admin/pdf.php" method="POST">
        <input type="hidden" name="MAX_FILE_SIZE" value="10000000" />
        <div>
            <?php echo $dictionary->SEND_THIS_FILE ?>: 
            <label for="uploadbtn" class="uploadButton">
            <?php echo $dictionary->UPLOAD_FILE ?>
            </label>
            <div class="list-pdf"></div>
            <input 
                style="opacity: 0; z-index: -1;" 
                type="file" name="userfile" id="uploadbtn" 
                onchange='document.querySelector(".uploadButton + div").innerHTML = Array.from(this.files).map(f => f.name).join("<br />")' 
            />
        </div>
        <input class="send-file" type="submit" value="<?php echo $dictionary->SEND_FILE ?>" />
    </form>

    <h3><?php echo $dictionary->UPLOADING_FILES ?></h3>

    <?php
        $files = array_diff(scandir($uploaddir), array('.', '..')); 

        echo "<ul>";
        foreach ($files as $file_name) {
            echo "<li><a href=\"/uploads/{$file_name}\">{$file_name}</a></li>";
        }

        echo "</ul>";
    ?>

    <h2><?php echo $dictionary->GRAPHICS ?></h2>

    <a href="/admin/graphics/index.php" class="uploadButton"><?php echo $dictionary->SHOW_GRAPHICS ?></a>

    
    <h2><?php echo $dictionary->ADMINISTRATORS ?></h2>
    <form action="/admin/insert_users.php" method="post">
        <p><?php echo $dictionary->LOGIN ?>: <input type="text" name="name" /></p>
        <p><?php echo $dictionary->PASSWORD ?>: <input type="password" name="password" /></p>
        <p><button type="submit"><?php echo $dictionary->SEND ?></button></p>
    </form>

    <?php

    $mysqli = new mysqli("db", "user", "password", "appDB");
    $result = $mysqli->query("SELECT * FROM users");
    echo "<ul>";
    foreach ($result as $row) {
        echo "<li>";

        echo "<a href=\"/admin/delete_users.php?ID={$row['ID']}\">";
        echo "X";
        echo "</a>";

        echo "{$row['ID']} {$row['name']}</li>";
    }
    echo "</ul>";
    ?>

    <h2><?php echo $dictionary->THEATRES ?></h2>
    <form action="/admin/insert_theatre.php" method="post">
        <p><?php echo $dictionary->IMG_SRC ?>: <input type="text" name="img_src" /></p>
        <p><?php echo $dictionary->URL_THEATRE ?>: <input type="text" name="url_theatre"/></p>
        <p><?php echo $dictionary->NAME_THEATRE ?>: <input type="text" name="name_theatre" /></p>
        <p><button type="submit"><?php echo $dictionary->SEND ?></button></p>
    </form>

    <?php
    $mysqli = new mysqli("db", "user", "password", "appDB");
    $result = $mysqli->query("SELECT * FROM theatres");
    echo "<ul>";
    foreach ($result as $row) {
        echo "<a href=\"/admin/delete_theatre.php?ID={$row['ID']}\">";
        echo "X";
        echo "</a>";
        echo '<div class="image_block"> 
                    <a target="_blank" href="' .$row['url_theatre'].'"><img src="' .$row['img_src'].'" width="100%" alt=""></a>
                    <p>' .$row['name_theatre']. '</p>
                </div>';
    }
    echo "</ul>";
    ?>
    </div>
</body>

</html>