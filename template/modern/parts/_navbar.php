<?php
# Modern Navbar - Sticky glassmorphism top bar
# Preserves all original menu items and member/language functionality

$main_menus = [
  'home' => [
    'text' => __('Home'),
    'url' => 'index.php',
    'icon' => 'home'
  ],
  'libinfo' => [
    'text' => __('Information'),
    'url' => 'index.php?p=libinfo',
    'icon' => 'info'
  ],
  'news' => [
    'text' => __('News'),
    'url' => 'index.php?p=news',
    'icon' => 'newspaper'
  ],
  'help' => [
    'text' => __('Help'),
    'url' => 'index.php?p=help',
    'icon' => 'help'
  ],
  'librarian' => [
    'text' => __('Librarian'),
    'url' => 'index.php?p=login',
    'icon' => 'badge'
  ]
];
?>
<!-- TopAppBar -->
<header class="bg-white/90 backdrop-blur-md sticky top-0 z-50 border-b border-emerald-900/5 shadow-[0_4px_20px_-2px_rgba(45,106,79,0.08)]" id="main-header">
    <div class="flex justify-between items-center px-4 h-16 w-full max-w-7xl mx-auto">
        <!-- Logo / Brand -->
        <a href="index.php" class="flex items-center gap-3 no-underline">
            <?php
            if(isset($sysconf['logo_image']) && $sysconf['logo_image'] != '' && $imagesDisk->isExists($path = 'default/'.$sysconf['logo_image'])){
                echo '<img class="h-8 w-auto" src="'.SWB . 'lib/minigalnano/createthumb.php?filename=images/' . $path.'&width=350">';
            } else {
            ?>
            <span class="material-symbols-outlined text-primary text-2xl">school</span>
            <?php } ?>
            <div>
                <h1 class="text-emerald-900 font-black tracking-tighter text-lg leading-tight m-0 p-0"><?php echo $sysconf['library_name']; ?></h1>
                <?php if ($sysconf['template']['classic_library_subname']) : ?>
                <p class="text-xs text-on-surface-variant m-0 p-0 leading-tight"><?php echo $sysconf['library_subname']; ?></p>
                <?php endif; ?>
            </div>
        </a>

        <!-- Desktop Navigation -->
        <nav class="hidden lg:flex items-center gap-1">
            <?php
            foreach ($main_menus as $key => $main_menu) {
                $active = '';
                if (isset($_GET['p'])) {
                    if ($key === $_GET['p']) $active = 'bg-primary/10 text-primary';
                } elseif ($key === 'home' && !isset($_GET['p']) && !isset($_GET['search'])) {
                    $active = 'bg-primary/10 text-primary';
                }
                echo '<a href="'.$main_menu['url'].'" class="px-3 py-2 rounded-lg text-sm font-medium text-on-surface-variant hover:bg-primary/5 hover:text-primary transition-colors no-underline '.$active.'">'.$main_menu['text'].'</a>';
            }
            ?>

            <?php
            // Member area
            $menu_member_active = isset($_GET['p']) && $_GET['p'] === 'member' ? 'bg-primary/10 text-primary' : '';
            if ($is_login) {
            ?>
                <a href="index.php?p=member&sec=title_basket" class="relative px-3 py-2 rounded-lg text-sm font-medium text-on-surface-variant hover:bg-primary/5 transition-colors no-underline">
                    <span class="material-symbols-outlined text-xl">shopping_basket</span>
                    <?php $count_basket = count($_SESSION['m_mark_biblio']); ?>
                    <?php if ($count_basket > 0): ?>
                    <span class="absolute -top-1 -right-1 bg-error text-white text-[10px] font-bold w-5 h-5 rounded-full flex items-center justify-center" id="count-basket"><?php echo $count_basket; ?></span>
                    <?php endif; ?>
                </a>
                <div class="relative group">
                    <button class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm font-medium text-on-surface-variant hover:bg-primary/5 transition-colors <?= $menu_member_active; ?>">
                        <img class="w-7 h-7 rounded-full object-cover ring-2 ring-primary/20" src="<?php echo $member_image_path; ?>" alt="Avatar">
                        <span class="hidden xl:inline"><?php echo $_SESSION['m_name']; ?></span>
                    </button>
                    <div class="absolute right-0 top-full mt-2 w-48 bg-white rounded-xl shadow-lg border border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                        <a href="index.php?p=member" class="flex items-center gap-2 px-4 py-3 text-sm text-on-surface hover:bg-primary/5 rounded-t-xl no-underline">
                            <span class="material-symbols-outlined text-lg">person</span> <?= __('Profile');?>
                        </a>
                        <a href="index.php?p=member&sec=bookmark" class="flex items-center gap-2 px-4 py-3 text-sm text-on-surface hover:bg-primary/5 no-underline">
                            <span class="material-symbols-outlined text-lg">bookmark</span> <?= __('Bookmark');?>
                        </a>
                        <hr class="my-0 border-gray-100">
                        <a href="index.php?p=member&logout=1" class="flex items-center gap-2 px-4 py-3 text-sm text-error hover:bg-error/5 rounded-b-xl no-underline">
                            <span class="material-symbols-outlined text-lg">logout</span> <?= __('Logout'); ?>
                        </a>
                    </div>
                </div>
            <?php } else { ?>
                <a href="index.php?p=member" class="px-4 py-2 bg-primary text-white rounded-lg text-sm font-semibold hover:bg-primary-container transition-colors no-underline <?= $menu_member_active; ?>">
                    <span class="material-symbols-outlined text-lg align-middle mr-1">login</span><?= __('Member Area') ?>
                </a>
            <?php } ?>

            <!-- Language Selector -->
            <div class="relative group ml-1">
                <?php
                $langstr = '';
                $current_lang = '';
                $select_lang = isset($_COOKIE['select_lang'])?$_COOKIE['select_lang']:$sysconf['default_lang'];
                foreach ($available_languages??[] AS $lang_index) {
                    $selected = null;
                    $lang_code = $lang_index[0];
                    $lang_name = $lang_index[1];
                    $code_arr = explode('_', $lang_code);
                    $code_flag = strtolower($code_arr[1]);
                    if ($lang_code == $select_lang) {
                        $current_lang = [
                            'name' => $lang_name,
                            'code' => $code_flag
                        ];
                    }
                    $langstr .= '<a class="flex items-center gap-2 px-4 py-2 text-sm text-on-surface hover:bg-primary/5 no-underline" href="index.php?select_lang='.$lang_code.'"><span class="flag-icon flag-icon-'.$code_flag.'" style="border-radius: 2px;"></span> '.$lang_name.'</a>';
                }
                ?>
                <button class="p-2 rounded-full hover:bg-primary/5 transition-colors">
                    <span class="flag-icon flag-icon-<?= $current_lang['code'] ?? 'id' ?>" style="border-radius: 2px;"></span>
                </button>
                <div class="absolute right-0 top-full mt-2 w-56 bg-white rounded-xl shadow-lg border border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50 max-h-80 overflow-y-auto">
                    <div class="px-4 py-2 text-xs font-semibold text-on-surface-variant uppercase"><?= __('Select Language'); ?></div>
                    <?= $langstr; ?>
                </div>
            </div>
        </nav>

        <!-- Mobile menu button -->
        <button class="lg:hidden p-2 rounded-full hover:bg-primary/5 transition-colors" onclick="document.getElementById('mobile-menu').classList.toggle('hidden')">
            <span class="material-symbols-outlined text-on-surface">menu</span>
        </button>
    </div>

    <!-- Mobile dropdown menu -->
    <div id="mobile-menu" class="hidden lg:hidden border-t border-gray-100 bg-white pb-4">
        <div class="px-4 pt-2 space-y-1">
            <?php
            foreach ($main_menus as $key => $main_menu) {
                $active = '';
                if (isset($_GET['p'])) {
                    if ($key === $_GET['p']) $active = 'bg-primary/10 text-primary';
                } elseif ($key === 'home' && !isset($_GET['p']) && !isset($_GET['search'])) {
                    $active = 'bg-primary/10 text-primary';
                }
                echo '<a href="'.$main_menu['url'].'" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-on-surface-variant hover:bg-primary/5 no-underline '.$active.'"><span class="material-symbols-outlined text-lg">'.$main_menu['icon'].'</span>'.$main_menu['text'].'</a>';
            }
            ?>
            <?php if (!$is_login): ?>
            <a href="index.php?p=member" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-on-surface-variant hover:bg-primary/5 no-underline">
                <span class="material-symbols-outlined text-lg">login</span><?= __('Member Area') ?>
            </a>
            <?php endif; ?>
        </div>
    </div>
</header>
