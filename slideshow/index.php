<?php

$fileRoot = '../';

require_once($fileRoot . 'lib/config.php');
require_once($fileRoot . 'lib/db.php');

$database = new DatabaseManager();
$database->db_file = DB_FILE;
$database->file_dir = IMG_DIR;
if ($config['database']['enabled']) {
    $images = $database->getContentFromDB();
} else {
    $images = $database->getFilesFromDirectory();
}

$imagelist = !empty($images) ? array_reverse($images) : $images;

if (!empty($imagelist) && $config['slideshow']['randomPicture']) {
    shuffle($imagelist);
}

$btnShape = 'shape--' . $config['ui']['button'];
$uiShape = 'shape--' . $config['ui']['style'];
$btnClass = 'btn btn--' . $config['ui']['button'];
$pageTitle = $config['ui']['branding'] . ' Slideshow';
$mainStyle = $config['ui']['style'] . '_style.css';
$photoswipe = true;
$remoteBuzzer = false;
$chromaKeying = false;
$GALLERY_FOOTER = false;

include($fileRoot . 'template/components/main.head.php');
?>

<body class="deselect">
	<div id="wrapper">
        <div id="gallery" class="gallery">
	        <div class="gallery__inner">
		        <div class="gallery__header">
			        <h1><span data-i18n="slideshow"></span></h1>
		        </div>
                <?php include($fileRoot . 'template/components/gal.images.php'); ?>
        </div>
	</div>

    <?php include($fileRoot . 'template/components/main.footer.php'); ?>

	<script type="text/javascript" src="<?=$fileRoot?>resources/js/slideshow.js?v=<?php echo $config['photobooth']['version']; ?>"></script>
</body>
</html>
