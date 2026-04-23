<!--
# ===============================
# Modern SLiMS Template
# ===============================
# Redesign OPAC with Material Design 3
-->
<?php
// clean request uri from xss
$request_uri = urlencode(strip_tags(urldecode($_SERVER['REQUEST_URI'])));
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title><?php echo $page_title; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="Pragma" content="no-cache"/>
    <meta http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate, post-check=0, pre-check=0"/>
    <meta http-equiv="Expires" content="Sat, 26 Jul 1997 05:00:00 GMT"/>
    <?php echo $metadata;?>
    <?php if (isset($_GET['p']) && ($_GET['p'] == 'show_detail')): ?>
        <meta name="description" content="<?php echo substr($notes, 0, 152) . '...'; ?>">
        <meta name="keywords" content="<?php echo $subject; ?>">
    <?php else: ?>
        <meta name="description" content="<?php echo $page_title; ?>">
        <meta name="keywords" content="<?php echo $sysconf['library_subname']; ?>">
    <?php endif; ?>
    <meta name="generator" content="<?php echo SENAYAN_VERSION ?>">
    <meta name="theme-color" content="#0f5238">

    <meta property="og:locale" content="<?php echo str_replace('-', '_', $sysconf['default_lang']); ?>"/>
    <meta property="og:type" content="book"/>
    <meta property="og:title" content="<?php echo $page_title; ?>"/>
    <?php if (isset($_GET['p']) && ($_GET['p'] == 'show_detail')): ?>
        <meta property="og:description" content="<?php echo substr($notes, 0, 152) . '...'; ?>"/>
    <?php else: ?>
        <meta property="og:description" content="<?php echo $sysconf['library_subname']; ?>"/>
    <?php endif; ?>
    <meta property="og:url" content="//<?php echo $_SERVER["SERVER_NAME"] . $request_uri; ?>"/>
    <meta property="og:site_name" content="<?php echo $sysconf['library_name']; ?>"/>
    <?php if (isset($_GET['p']) && ($_GET['p'] == 'show_detail')): ?>
        <meta property="og:image" content="//<?php echo $_SERVER["SERVER_NAME"] . SWB . $image_src ?>"/>
    <?php else: ?>
        <meta property="og:image"
              content="//<?php echo $_SERVER["SERVER_NAME"] . SWB . $sysconf['template']['dir']; ?>/modern/assets/images/logo.png"/>
    <?php endif; ?>

    <meta name="twitter:card" content="summary">
    <meta name="twitter:url" content="//<?php echo $_SERVER["SERVER_NAME"] . $request_uri; ?>"/>
    <meta name="twitter:title" content="<?php echo $page_title; ?>"/>
    <?php if (isset($_GET['p']) && ($_GET['p'] == 'show_detail')): ?>
        <meta property="twitter:image" content="//<?php echo $_SERVER["SERVER_NAME"] . SWB . $image_src ?>"/>
    <?php else: ?>
        <meta property="twitter:image"
              content="//<?php echo $_SERVER["SERVER_NAME"] . SWB . $sysconf['template']['dir']; ?>/modern/assets/images/logo.png"/>
    <?php endif; ?>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <!-- Google Fonts: Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <!-- Material Symbols -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <!-- Flag css (for language selector) -->
    <link rel="stylesheet" href="<?php echo assets('css/flag-icon.min.css'); ?>">

    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "surface-dim": "#d5dae2",
                        "tertiary": "#005236",
                        "on-error": "#ffffff",
                        "on-secondary-fixed-variant": "#004493",
                        "primary-fixed": "#b1f0ce",
                        "on-tertiary": "#ffffff",
                        "inverse-primary": "#95d4b3",
                        "on-surface": "#161c22",
                        "inverse-on-surface": "#ecf1f9",
                        "surface-variant": "#dde3eb",
                        "error-container": "#ffdad6",
                        "on-error-container": "#93000a",
                        "on-surface-variant": "#404943",
                        "tertiary-fixed-dim": "#75daa8",
                        "outline-variant": "#bfc9c1",
                        "on-primary-container": "#a8e7c5",
                        "inverse-surface": "#2b3137",
                        "surface-tint": "#2c694e",
                        "secondary-fixed-dim": "#adc7ff",
                        "on-secondary-fixed": "#001a41",
                        "surface-container-low": "#eff4fc",
                        "surface-container-high": "#e3e9f0",
                        "on-secondary": "#ffffff",
                        "surface": "#f7f9ff",
                        "primary-fixed-dim": "#95d4b3",
                        "on-tertiary-container": "#89edba",
                        "secondary": "#0059bb",
                        "tertiary-fixed": "#92f7c3",
                        "secondary-container": "#0070ea",
                        "on-primary-fixed-variant": "#0e5138",
                        "on-tertiary-fixed-variant": "#005235",
                        "error": "#ba1a1a",
                        "secondary-fixed": "#d8e2ff",
                        "on-background": "#161c22",
                        "primary": "#0f5238",
                        "surface-container-highest": "#dde3eb",
                        "on-secondary-container": "#fefcff",
                        "outline": "#707973",
                        "tertiary-container": "#006d48",
                        "surface-bright": "#f7f9ff",
                        "on-primary": "#ffffff",
                        "surface-container": "#e9eef6",
                        "primary-container": "#2d6a4f",
                        "on-tertiary-fixed": "#002113",
                        "background": "#f7f9ff",
                        "on-primary-fixed": "#002114",
                        "surface-container-lowest": "#ffffff"
                    },
                    borderRadius: {
                        DEFAULT: "0.25rem",
                        lg: "0.5rem",
                        xl: "0.75rem",
                        "2xl": "1rem",
                        "3xl": "1.5rem",
                        full: "9999px"
                    },
                    fontFamily: {
                        inter: ["Inter", "system-ui", "sans-serif"],
                    },
                    fontSize: {
                        "headline-sm": ["20px", { lineHeight: "1.4", fontWeight: "600" }],
                        "label-md": ["12px", { lineHeight: "1", letterSpacing: "0.05em", fontWeight: "600" }],
                        "headline-xl": ["40px", { lineHeight: "1.2", letterSpacing: "-0.02em", fontWeight: "700" }],
                        "headline-md": ["24px", { lineHeight: "1.3", fontWeight: "600" }],
                        "headline-lg": ["32px", { lineHeight: "1.25", letterSpacing: "-0.01em", fontWeight: "700" }],
                        "body-lg": ["18px", { lineHeight: "1.6", fontWeight: "400" }],
                        "body-md": ["16px", { lineHeight: "1.6", fontWeight: "400" }],
                        "body-sm": ["14px", { lineHeight: "1.5", fontWeight: "400" }]
                    }
                },
            },
        }
    </script>

    <style>
        * { font-family: 'Inter', system-ui, sans-serif; }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .hide-scrollbar::-webkit-scrollbar { display: none; }
        .hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>

    <!-- Toastr for notifications -->
    <link href="<?php echo JWB; ?>toastr/toastr.min.css?<?php echo date('this') ?>" rel="stylesheet" type="text/css"/>
    <!-- CKEditor5 CSS -->
    <link rel="stylesheet" href="<?= JWB; ?>ckeditor5/ckeditor5.css">
    <!-- SLiMS CSS -->
    <link rel="stylesheet" href="<?= JWB; ?>colorbox/colorbox.css">
    <link rel="stylesheet" href="<?= JWB; ?>ion.rangeSlider/css/ion.rangeSlider.min.css">

    <!-- Custom styles for modern template -->
    <link rel="stylesheet" href="<?php echo assets('css/style.css?v=' . date('Ymd-his')); ?>">

    <?php
    $icon = SWB . 'webicon.ico';
    if (isset($sysconf['webicon']) && !empty($sysconf['webicon']) && $imagesDisk->isExists($path = 'default/' . $sysconf['webicon']))
    {
        $icon = SWB . 'lib/minigalnano/createthumb.php?filename=images/' . $path . '&width=130';
    }
    ?>
    <link rel="shortcut icon" href="<?= $icon ?>" type="image/x-icon"/>

    <!-- Vue.js -->
    <script src="<?php echo assets('js/vue.min.js'); ?>"></script>
    <!-- jQuery -->
    <script src="<?php echo assets('js/jquery.min.js'); ?>"></script>
    <script src="<?php echo assets('js/masonry.pkgd.min.js'); ?>"></script>
    <!-- Toastr -->
    <script src="<?php echo JWB; ?>toastr/toastr.min.js"></script>
    <!-- SLiMS JS -->
    <script src="<?= JWB; ?>colorbox/jquery.colorbox-min.js"></script>
    <script src="<?php echo JWB . v('gui.js'); ?>"></script>
    <script src="<?php echo JWB; ?>fancywebsocket.js"></script>
    <script src="<?php echo JWB; ?>ion.rangeSlider/js/ion.rangeSlider.min.js"></script>
    <?php
    if (isset($js)):
        echo $js;
    endif;
    ?>

</head>
<body class="bg-background text-on-background font-inter antialiased">
