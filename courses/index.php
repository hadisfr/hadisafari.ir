<!DOCTYPE html>
<!--
    © 2019 Hadi Safari
    
    http://hadisafari.ir
    info[at]hadisafari.ir
-->
<?php
    $root=".";
    $desc_suffix = "/desc.html";
    $title_suffix = "/title.html";
    $background_suffix = "/bg.jpg";
    $rtl_suffix = "/rtl";
    /*
        example_course
        ├── bg.jpg
        ├── cnt
        │   └── example_file
        ├── desc.html
        ├── index.php (redirection)
        ├── (rtl)
        └── title.html
    */
    $dir = scandir($root);
    $titles = [];
    $rtl = [];
    for ($i=0; $i < count($dir); $i++)
        if(strpos($dir[$i], ".") === false) {
            $title_file = fopen($root . "/" . $dir[$i] . $title_suffix, "r") or die("Unable to open title file!");
            $titles[$dir[$i]] = fread($title_file, filesize($root . "/" . $dir[$i] . $title_suffix));
            fclose($title_file);
            $rtl[$dir[$i]] = file_exists($root . "/" . $dir[$i] . $rtl_suffix);
        }
?>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Courses</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="icon" type="image/png" href="icon.png">
</head>
<body>
    <div class="part" id="courses">
        <div class="bg" style="background-image: url('bg.jpg');"></div>
        <h1><span class="fa-graduation-cap"></span>&nbsp;Courses</h1>
        <ul>
            <?php
                for ($i=0; $i < count($dir); $i++)
                    if(strpos($dir[$i], ".") === false)
                        echo "<li><a href=\"#" . $dir[$i] . "\""
                            . " class=\"" . (($rtl[$dir[$i]]) ? " rtl" : "") . "\">"
                            . $titles[$dir[$i]] . "</a></li>";
            ?>
        </ul>
    </div>
    <?php
        for ($i=0; $i < count($dir); $i++)
            if(strpos($dir[$i], ".") === false) {
                $desc_file = fopen($root . "/" . $dir[$i] . $desc_suffix, "r") or die("Unable to open desc file!");
                $desc = fread($desc_file, filesize($root . "/" . $dir[$i] . $desc_suffix));
                fclose($desc_file);
                echo "
    <div class=\"part" . (($rtl[$dir[$i]]) ? " rtl" : "") . "\" id=\"". $dir[$i] . "\">
        <div class=\"bg\" style=\"background-image: url('" . $root . "/" . $dir[$i] . $background_suffix . "');\"></div>
        <h2>" . $titles[$dir[$i]] . "</h2>
        ". $desc . "
    </div>
                ";
            }
    ?>

    <div class="footer">
        <a href="http://hadisafari.ir"><span class="fa-home"></span></a> <span class="sep"></span>
        <a href="#courses"><span class="fa-graduation-cap"></span></a> <span class="sep"></span>
        &copy; Hadi Safari
    </div>
    <script type="text/javascript">
        function sync_bg_size() {
            for (let elm of document.getElementsByClassName("bg"))
                elm.style.height = elm.parentNode.clientHeight + "px";
        }
        window.addEventListener("resize", sync_bg_size);
        sync_bg_size();
    </script>
</body>
</html>