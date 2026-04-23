<?php
# Modern Footer - Desktop footer + Mobile bottom nav
?>

<!-- Mobile Bottom Navigation -->
<nav class="md:hidden fixed bottom-0 left-0 w-full z-50 bg-white/95 backdrop-blur-lg border-t border-emerald-900/5 shadow-[0_-8px_30px_rgba(45,106,79,0.05)] px-4 pt-2 pb-6 flex justify-around items-center">
    <a class="flex flex-col items-center justify-center <?= (!isset($_GET['p']) && !isset($_GET['search'])) ? 'bg-emerald-50 text-emerald-800 rounded-xl px-3 py-1.5' : 'text-slate-400 hover:text-emerald-600 px-3 py-1.5' ?> transition-all no-underline" href="index.php">
        <span class="material-symbols-outlined" <?= (!isset($_GET['p']) && !isset($_GET['search'])) ? 'style="font-variation-settings: \'FILL\' 1;"' : '' ?>>home</span>
        <span class="text-[11px] font-semibold uppercase tracking-wider">Home</span>
    </a>
    <a class="flex flex-col items-center justify-center <?= (isset($_GET['search'])) ? 'bg-emerald-50 text-emerald-800 rounded-xl px-3 py-1.5' : 'text-slate-400 hover:text-emerald-600 px-3 py-1.5' ?> transition-all no-underline" href="javascript:void(0)" onclick="document.getElementById('search-input')?.focus();window.scrollTo({top:0,behavior:'smooth'});">
        <span class="material-symbols-outlined">search</span>
        <span class="text-[11px] font-semibold uppercase tracking-wider">Search</span>
    </a>
    <a class="flex flex-col items-center justify-center <?= (isset($_GET['p']) && $_GET['p']==='member') ? 'bg-emerald-50 text-emerald-800 rounded-xl px-3 py-1.5' : 'text-slate-400 hover:text-emerald-600 px-3 py-1.5' ?> transition-all no-underline" href="index.php?p=member">
        <span class="material-symbols-outlined">local_library</span>
        <span class="text-[11px] font-semibold uppercase tracking-wider"><?= __('Library'); ?></span>
    </a>
    <a class="flex flex-col items-center justify-center text-slate-400 hover:text-emerald-600 px-3 py-1.5 transition-all no-underline" href="index.php?p=member">
        <span class="material-symbols-outlined">person</span>
        <span class="text-[11px] font-semibold uppercase tracking-wider">Profile</span>
    </a>
</nav>

<!-- Desktop Footer -->
<footer class="hidden md:block py-12 bg-surface-container-low border-t border-emerald-900/5">
    <div class="max-w-7xl mx-auto px-4 grid grid-cols-4 gap-8">
        <div class="col-span-2">
            <div class="flex items-center gap-2 mb-4">
                <?php
                if(isset($sysconf['logo_image']) && $sysconf['logo_image'] != '' && $imagesDisk->isExists($path = 'default/'.$sysconf['logo_image'])){
                    echo '<img class="h-8 w-auto" src="'.SWB.'lib/minigalnano/createthumb.php?filename=images/'.$path.'&width=350">';
                } else {
                    echo '<span class="material-symbols-outlined text-primary text-2xl">school</span>';
                }
                ?>
                <h3 class="text-emerald-900 font-black tracking-tighter text-xl m-0"><?= $sysconf['library_name']; ?></h3>
            </div>
            <p class="text-on-surface-variant text-sm max-w-md leading-relaxed"><?= $sysconf['template']['classic_footer_about_us']; ?></p>
            <div class="flex gap-2 mt-4">
                <?php if (!empty($sysconf['template']['classic_fb_link'])): ?>
                <a href="<?= $sysconf['template']['classic_fb_link'] ?>" target="_blank" class="w-9 h-9 rounded-full bg-primary/10 flex items-center justify-center text-primary hover:bg-primary hover:text-white transition-all no-underline">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                </a>
                <?php endif; ?>
                <?php if (!empty($sysconf['template']['classic_instagram_link'])): ?>
                <a href="<?= $sysconf['template']['classic_instagram_link'] ?>" target="_blank" class="w-9 h-9 rounded-full bg-primary/10 flex items-center justify-center text-primary hover:bg-primary hover:text-white transition-all no-underline">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                </a>
                <?php endif; ?>
                <?php if (!empty($sysconf['template']['classic_youtube_link'])): ?>
                <a href="<?= $sysconf['template']['classic_youtube_link'] ?>" target="_blank" class="w-9 h-9 rounded-full bg-primary/10 flex items-center justify-center text-primary hover:bg-primary hover:text-white transition-all no-underline">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 00-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 00.502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 002.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 002.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                </a>
                <?php endif; ?>
            </div>
        </div>
        <div>
            <h4 class="font-bold text-primary mb-4 text-sm"><?= __('Navigation'); ?></h4>
            <ul class="space-y-2 text-on-surface-variant text-sm list-none p-0 m-0">
                <li><a class="hover:text-primary no-underline transition-colors" href="index.php?p=libinfo"><?= __('Information'); ?></a></li>
                <li><a class="hover:text-primary no-underline transition-colors" href="index.php"><?= __('Catalog'); ?></a></li>
                <li><a class="hover:text-primary no-underline transition-colors" href="index.php?p=member"><?= __('Member Area'); ?></a></li>
                <li><a class="hover:text-primary no-underline transition-colors" href="index.php?p=news"><?= __('News'); ?></a></li>
            </ul>
        </div>
        <div>
            <h4 class="font-bold text-primary mb-4 text-sm"><?= __('Contact'); ?></h4>
            <ul class="space-y-2 text-on-surface-variant text-sm list-none p-0 m-0">
                <li class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-sm">location_on</span>
                    Selong, Lombok Timur
                </li>
                <li class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-sm">mail</span>
                    perpus@mandualotim.sch.id
                </li>
            </ul>
        </div>
    </div>
    <div class="max-w-7xl mx-auto px-4 mt-10 pt-6 border-t border-emerald-900/5 text-center text-outline text-sm">
        &copy; <?= date('Y') ?> <?= $sysconf['library_name']; ?>. <?= __('Powered by'); ?> <a href="https://slims.web.id" class="text-primary no-underline font-medium" target="_blank">SLiMS</a>
    </div>
</footer>

<?php if ($sysconf['chat_system']['enabled'] && $sysconf['chat_system']['opac']) : ?>
    <div id="show-pchat2" style="position: fixed; bottom: 80px; right: 16px" class="shadow-lg rounded-full z-40">
        <button title="Chat" class="w-12 h-12 bg-primary text-white rounded-full flex items-center justify-center shadow-lg hover:bg-primary-container transition-colors">
            <span class="material-symbols-outlined">chat</span>
        </button>
    </div>
<?php endif; ?>

<?php include LIB . "contents/chat.php"; ?>

<!-- Modals -->
<?php include "_modal_topic.php"; ?>
<?php include "_modal_advanced.php"; ?>
<?php include "_modal_social_media.php"; ?>

<!-- Highlight -->
<script src="<?= JWB; ?>highlight.js"></script>
<?php if(isset($engine) && $searchableInJsArray = $this->generateKeywords($engine->searchable_fields)) : ?>
<script>
  $('.card-body > *').highlight(<?= $searchableInJsArray ?>);
</script>
<?php endif; ?>

<!-- Vue app -->
<script src="<?php echo assets(v('js/app.js')); ?>"></script>
<script src="<?php echo assets(v('js/app_jquery.js')); ?>"></script>

<?php if ($sysconf['chat_system']['enabled'] && $sysconf['chat_system']['opac']) : ?>
    <script>
        $('#show-pchat').click(() => { $('.s-chat').hide(); $('#show-pchat2').show(); });
        $('#show-pchat2').click(() => { $('.s-chat').show(300, () => { $('#show-pchat2').hide(); }); });
    </script>
<?php endif; ?>

<!-- Bootstrap JS for modals compatibility -->
<script>
// Minimal modal toggle for data-toggle="modal"
$(document).on('click', '[data-toggle="modal"]', function(e) {
    e.preventDefault();
    var target = $(this).data('target');
    $(target).addClass('show').css('display','block');
    $('body').addClass('modal-open').append('<div class="modal-backdrop fade show"></div>');
});
$(document).on('click', '.modal .close, .modal [data-dismiss="modal"], .modal-backdrop', function() {
    $('.modal').removeClass('show').css('display','none');
    $('body').removeClass('modal-open');
    $('.modal-backdrop').remove();
});
</script>

</body>
</html>
