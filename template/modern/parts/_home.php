<?php
# Modern Home Page - PHP-rendered collections with dynamic stats

// Get stats from database
$stats_total = 0; $stats_members = 0; $stats_new_month = 0;
$q = $dbs->query("SELECT COUNT(*) FROM biblio"); if ($q) { $r = $q->fetch_row(); $stats_total = $r[0]; }
$q = $dbs->query("SELECT COUNT(DISTINCT member_id) FROM loan WHERE is_lent=1 AND is_return=0"); if ($q) { $r = $q->fetch_row(); $stats_members = $r[0]; }
$q = $dbs->query("SELECT COUNT(*) FROM biblio WHERE last_update >= DATE_SUB(NOW(), INTERVAL 30 DAY)"); if ($q) { $r = $q->fetch_row(); $stats_new_month = $r[0]; }
$stats_total_display = $stats_total >= 1000 ? number_format($stats_total/1000, 1) . 'K+' : $stats_total;

// Helper: get author name
function getFirstAuthor($dbs, $biblio_id) {
    $q = $dbs->query("SELECT ma.author_name FROM biblio_author ba LEFT JOIN mst_author ma ON ba.author_id=ma.author_id WHERE ba.biblio_id=".(int)$biblio_id." LIMIT 1");
    return ($q && $q->num_rows > 0) ? $q->fetch_row()[0] : '';
}
// Helper: get availability count
function getAvail($dbs, $biblio_id) {
    $q1 = $dbs->query('SELECT COUNT(*) FROM item WHERE biblio_id='.(int)$biblio_id); $c1 = $q1->fetch_row()[0];
    $q2 = $dbs->query('SELECT COUNT(*) FROM loan l INNER JOIN item i ON l.item_code=i.item_code WHERE l.is_lent=1 AND l.is_return=0 AND i.biblio_id='.(int)$biblio_id); $c2 = $q2->fetch_row()[0];
    return $c1 - $c2;
}
// Helper: time ago
function timeAgo($dbs, $biblio_id) {
    $q = $dbs->query("SELECT DATEDIFF(NOW(), last_update) FROM biblio WHERE biblio_id=".(int)$biblio_id);
    $d = ($q && $q->num_rows) ? (int)$q->fetch_row()[0] : 0;
    if ($d == 0) return __('Today'); if ($d == 1) return '1 ' . __('day ago');
    if ($d < 7) return $d . ' ' . __('days ago'); if ($d < 30) return floor($d/7) . ' ' . __('weeks ago');
    return floor($d/30) . ' ' . __('months ago');
}
?>

<section id="section1 container-fluid">
    <header class="c-header" style="display:none;"><div class="mask"></div><?php include '_navbar.php'; ?></header>
    <?php include '_search-form.php'; ?>
</section>

<div id="slims-home">
<main class="max-w-7xl mx-auto pb-24 md:pb-12">

<!-- Hero -->
<section class="px-4 pt-8 pb-6 bg-gradient-to-b from-primary-fixed/30 to-transparent">
    <div class="max-w-3xl mb-4">
        <h2 class="text-headline-lg font-bold text-primary mb-2"><?= __('Welcome to the Digital Library'); ?></h2>
        <p class="text-body-md text-on-surface-variant"><?= __('Find thousands of books, journals, and academic references to support your learning.'); ?></p>
    </div>
</section>

<!-- Subject Icons Grid -->
<section class="px-4 py-6">
    <div class="grid grid-cols-4 md:grid-cols-8 gap-4">
<?php
$subjects = [
    ['8','menu_book',__('Literature')], ['3','public',__('Social')],
    ['5','science',__('Science')], ['9','history_edu',__('History')],
    ['2','mosque',__('Religion')], ['5','calculate',__('Math')],
    ['4','translate',__('Language')],
];
foreach ($subjects as $s) {
    echo '<a href="index.php?callnumber='.$s[0].'&search=search" class="flex flex-col items-center gap-2 group no-underline">
        <div class="w-14 h-14 md:w-16 md:h-16 rounded-xl bg-primary/10 flex items-center justify-center text-primary group-hover:bg-primary group-hover:text-white transition-all duration-300 shadow-sm group-hover:shadow-md group-hover:scale-105">
            <span class="material-symbols-outlined text-2xl md:text-3xl">'.$s[1].'</span>
        </div>
        <span class="text-[10px] md:text-[11px] font-semibold text-center uppercase tracking-tight text-on-surface-variant">'.$s[2].'</span>
    </a>';
}
?>
        <a href="javascript:void(0)" class="flex flex-col items-center gap-2 group no-underline" data-toggle="modal" data-target="#exampleModal">
            <div class="w-14 h-14 md:w-16 md:h-16 rounded-xl bg-primary/10 flex items-center justify-center text-primary group-hover:bg-primary group-hover:text-white transition-all duration-300 shadow-sm">
                <span class="material-symbols-outlined text-2xl md:text-3xl">more_horiz</span>
            </div>
            <span class="text-[10px] md:text-[11px] font-semibold text-center uppercase tracking-tight text-on-surface-variant"><?= __('More'); ?></span>
        </a>
    </div>
</section>

<?php if ($sysconf['template']['classic_popular_collection']) : ?>
<!-- Popular Collections -->
<section class="py-6">
    <div class="flex justify-between items-end px-4 mb-5">
        <div>
            <h3 class="text-headline-md font-semibold text-on-surface m-0"><?= __('Popular Collection'); ?></h3>
            <p class="text-body-sm text-on-surface-variant m-0"><?= __('Most borrowed books'); ?></p>
        </div>
    </div>
    <div class="flex overflow-x-auto gap-5 px-4 hide-scrollbar pb-4">
<?php
$popular = getPopularBiblio($dbs, $sysconf['template']['classic_popular_collection_item'] ?? 8);
foreach ($popular as $b) {
    $img = empty($b['image']) ? 'images/default/image.png' : 'images/docs/'.$b['image'];
    $thumb = './lib/minigalnano/createthumb.php?filename='.urlencode($img).'&width=300';
    $url = SWB.'index.php?p=show_detail&id='.$b['biblio_id'];
    $t = mb_strlen($b['title'])>50 ? mb_substr($b['title'],0,50).'…' : $b['title'];
    $avail = getAvail($dbs, $b['biblio_id']);
    $author = getFirstAuthor($dbs, $b['biblio_id']);
    $badge = $avail > 0 ? '<span class="absolute top-2 right-2 bg-emerald-500/90 text-white text-[10px] font-bold px-2 py-1 rounded-full backdrop-blur-sm">'.__('Available').'</span>' : '<span class="absolute top-2 right-2 bg-red-500/90 text-white text-[10px] font-bold px-2 py-1 rounded-full backdrop-blur-sm">'.__('Borrowed').'</span>';
    echo '<a href="'.$url.'" class="flex-shrink-0 w-36 md:w-44 group no-underline">
        <div class="relative aspect-[2/3] rounded-xl overflow-hidden shadow-md group-hover:shadow-xl transition-all mb-3">
            <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" src="'.$thumb.'" alt="'.htmlspecialchars($t).'" loading="lazy">'.$badge.'
        </div>
        <h4 class="text-[14px] font-semibold leading-tight text-on-surface line-clamp-2 mb-1">'.htmlspecialchars($t).'</h4>
        <p class="text-[12px] text-outline m-0 truncate">'.htmlspecialchars($author).'</p>
    </a>';
}
?>
    </div>
</section>
<?php endif; ?>

<?php if ($sysconf['template']['classic_new_collection']) : ?>
<!-- New Arrivals -->
<section class="px-4 py-6">
    <div class="mb-5">
        <h3 class="text-headline-md font-semibold text-on-surface m-0"><?= __('New Collections'); ?></h3>
        <p class="text-body-sm text-on-surface-variant m-0"><?= __('Recently added'); ?></p>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
<?php
$latest = getLatestBiblio($dbs, $sysconf['template']['classic_new_collection_item'] ?? 6);
foreach ($latest as $b) {
    $img = empty($b['image']) ? 'images/default/image.png' : 'images/docs/'.$b['image'];
    $thumb = './lib/minigalnano/createthumb.php?filename='.urlencode($img).'&width=200';
    $url = SWB.'index.php?p=show_detail&id='.$b['biblio_id'];
    $t = mb_strlen($b['title'])>60 ? mb_substr($b['title'],0,60).'…' : $b['title'];
    $author = getFirstAuthor($dbs, $b['biblio_id']);
    $ago = timeAgo($dbs, $b['biblio_id']);
    echo '<a href="'.$url.'" class="flex gap-4 p-3 bg-white rounded-2xl shadow-sm border border-emerald-900/5 hover:shadow-md transition-all no-underline group">
        <div class="w-20 h-28 md:w-24 md:h-32 flex-shrink-0 rounded-lg overflow-hidden">
            <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" src="'.$thumb.'" loading="lazy">
        </div>
        <div class="flex flex-col justify-center min-w-0">
            <span class="inline-block w-max px-2 py-0.5 bg-secondary/10 text-secondary text-[10px] font-bold rounded uppercase mb-1">New</span>
            <h4 class="text-[14px] font-semibold text-on-surface mb-1 leading-tight line-clamp-2">'.htmlspecialchars($t).'</h4>
            <p class="text-[12px] text-outline m-0 mb-2 truncate">'.htmlspecialchars($author).'</p>
            <div class="flex items-center gap-1 text-primary">
                <span class="material-symbols-outlined text-sm">calendar_today</span>
                <span class="text-[12px]">'.$ago.'</span>
            </div>
        </div>
    </a>';
}
?>
    </div>
</section>
<?php endif; ?>

<?php if ($sysconf['template']['classic_top_reader']) : ?>
<!-- Top Readers -->
<section class="px-4 py-6">
    <div class="mb-5">
        <h3 class="text-headline-md font-semibold text-on-surface m-0"><?= __('Top Readers'); ?></h3>
        <p class="text-body-sm text-on-surface-variant m-0"><?= __('Most active members this year'); ?></p>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
<?php
$readers = getActiveMembers($dbs, date('Y'), 3);
$rank = 1; $colors = ['bg-amber-400','bg-gray-300','bg-amber-700'];
foreach ($readers as $r) {
    $mimg = getImagePath($sysconf, $r['image'], 'persons');
    $c = $colors[$rank-1] ?? 'bg-gray-200';
    echo '<div class="flex items-center gap-4 p-4 bg-white rounded-2xl shadow-sm border border-emerald-900/5">
        <div class="relative flex-shrink-0">
            <img class="w-14 h-14 rounded-full object-cover ring-2 ring-primary/20" src="'.$mimg.'">
            <span class="absolute -top-1 -right-1 w-6 h-6 '.$c.' rounded-full flex items-center justify-center text-white text-xs font-bold shadow">'.$rank.'</span>
        </div>
        <div>
            <h4 class="text-sm font-semibold text-on-surface m-0">'.htmlspecialchars($r['name']).'</h4>
            <p class="text-xs text-outline m-0">'.htmlspecialchars($r['type']).'</p>
            <span class="text-xs text-primary font-medium">'.$r['total'].' '.__('loans').'</span>
        </div>
    </div>';
    $rank++;
}
if (empty($readers)) echo '<div class="col-span-full text-center py-8 text-on-surface-variant"><span class="material-symbols-outlined text-4xl mb-2 block opacity-40">person_off</span><p class="text-sm">'.__('No data yet').'</p></div>';
?>
    </div>
</section>
<?php endif; ?>

<!-- Stats Bento -->
<section class="px-4 py-6">
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <div class="p-6 bg-primary-container text-on-primary-container rounded-3xl flex flex-col items-center justify-center text-center hover:scale-[1.02] transition-transform">
            <span class="material-symbols-outlined text-2xl mb-1 opacity-70">library_books</span>
            <span class="text-3xl font-black mb-1"><?= $stats_total_display ?></span>
            <span class="text-[11px] font-semibold uppercase opacity-80"><?= __('Total Collection'); ?></span>
        </div>
        <div class="p-6 bg-surface-container-high rounded-3xl flex flex-col items-center justify-center text-center hover:scale-[1.02] transition-transform">
            <span class="material-symbols-outlined text-2xl mb-1 text-primary opacity-70">group</span>
            <span class="text-3xl font-black text-primary mb-1"><?= $stats_members ?></span>
            <span class="text-[11px] font-semibold uppercase text-on-surface-variant"><?= __('Active Borrowers'); ?></span>
        </div>
        <div class="p-6 bg-surface-container-high rounded-3xl flex flex-col items-center justify-center text-center hover:scale-[1.02] transition-transform">
            <span class="material-symbols-outlined text-2xl mb-1 text-primary opacity-70">auto_stories</span>
            <span class="text-3xl font-black text-primary mb-1"><?= $stats_new_month ?></span>
            <span class="text-[11px] font-semibold uppercase text-on-surface-variant"><?= __('New This Month'); ?></span>
        </div>
        <div class="p-6 bg-tertiary-container text-on-tertiary-container rounded-3xl flex flex-col items-center justify-center text-center hover:scale-[1.02] transition-transform">
            <span class="material-symbols-outlined text-2xl mb-1 opacity-70">schedule</span>
            <span class="text-3xl font-black mb-1">24/7</span>
            <span class="text-[11px] font-semibold uppercase opacity-80"><?= __('Digital Access'); ?></span>
        </div>
    </div>
</section>

</main>
</div>