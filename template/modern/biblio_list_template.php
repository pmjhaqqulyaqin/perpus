<?php
/**
 * Modern Biblio List Template
 * Restyled card layouts for search results
 */
use SLiMS\Url;
$label_cache = array();

function biblio_list_format($dbs, $biblio_detail, $n, $settings = array(), &$return_back = array()) {
    global $label_cache, $sysconf;
    $output     = '';
    $title      = $biblio_detail['title'];
    $biblio_id  = $biblio_detail['biblio_id'];
    $detail_url = SWB.'index.php?p=show_detail&id='.$biblio_id.'&keywords='.urlencode($settings['keywords']??'');
    $cite_url   = SWB.'index.php?p=cite&id='.$biblio_id.'&keywords='.$settings['keywords'];

    // image thumbnail
    $images_loc = 'images/docs/'.$biblio_detail['image'];
    if($biblio_detail['image'] == '' || $biblio_detail['image'] == NULL){
        $images_loc = 'images/default/image.png';
    }
    $thumb_url = './lib/minigalnano/createthumb.php?filename='.urlencode($images_loc).'&width=240';

    // notes
    $notes = getNotes($dbs, $biblio_id);
    $custom_field = '';
    $grid_item_content = '';
    $i = 0;
    $expand = true;
    if ($settings['enable_custom_frontpage'] AND $settings['custom_fields']) {
        $custom_field = '<div class="space-y-1 text-sm mt-3">';
        foreach ($settings['custom_fields'] as $field => $field_opts) {
            if ($field_opts[0] == 1) {
                $field_value = (trim($biblio_detail[$field]??'') !== '' ? $biblio_detail[$field] : '-');
                $custom_field .= '<div class="flex gap-2"><span class="font-medium text-on-surface-variant w-32 flex-shrink-0">'.$field_opts[1].'</span><span class="text-on-surface">'.$field_value.'</span></div>';
                $grid_item_content .= '<div class="px-3 py-1.5 border-t border-gray-50 text-xs flex justify-between"><span class="text-on-surface-variant">'.$field_opts[1].'</span><span>'.$field_value.'</span></div>';
                $i++;
            }
        }
        $custom_field .= '</div>';
    }
    if (empty($notes)) {
        $notes = $custom_field;
        $expand = false;
    }

    // availability
    $availability = getAvailability($dbs, $biblio_id, $sysconf);
    $avail_color = ($availability > 0) ? 'text-emerald-600' : 'text-red-500';
    $avail_bg = ($availability > 0) ? 'bg-emerald-50' : 'bg-red-50';

    // authors
    $_authors = isset($biblio_detail['author'])?$biblio_detail['author']:biblio_list_model::getAuthors($dbs, $biblio_id, true);
    $_authors_string = '';
    if ($_authors) {
        if (!is_array($_authors)) {
            $_authors = explode('-', $_authors);
        }
        foreach ($_authors as $a) {
            $a = trim($a);
            $_authors_string .= '<a href="index.php?author='.urlencode($a).'&search=Search" class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-primary/5 text-primary hover:bg-primary/10 transition-colors no-underline mr-1 mb-1">'.$a.'</a>';
        }
    }

    if (($_POST['view'] ?? $_SESSION['LIST_VIEW'] ?? 'list') === 'list'):

        $output .= '<div id="card-' . $biblio_id . '" class="bg-white rounded-2xl shadow-sm border border-emerald-900/5 hover:shadow-md transition-all mb-4 overflow-hidden">';
        $output .= '<div class="p-4 md:p-5">';
        $output .= '<div class="flex gap-4">';
        // Cover image
        $output .= '<div class="w-20 md:w-28 flex-shrink-0">';
        $output .= '<div class="aspect-[2/3] rounded-xl overflow-hidden shadow-sm '.($availability > 0 ? '' : 'opacity-60').'">';
        $output .= '<img loading="lazy" src="'.$thumb_url.'" alt="cover" class="w-full h-full object-cover" title="' . ($availability > 0 ? __('Available') : __('Items is not available')) . '"/>';
        $output .= '</div>';
        $output .= '</div>';
        // Content
        $output .= '<div class="flex-1 min-w-0">';
        $output .= '<h5 class="text-base font-semibold text-on-surface mb-1 leading-tight"><a title="'.__('View record detail description for this title').'" class="text-on-surface hover:text-primary no-underline transition-colors" href="'.$detail_url.'">'.addEllipsis($title, 80).'</a></h5>';
        // Availability badge
        $output .= '<span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-bold uppercase '.$avail_bg.' '.$avail_color.' mb-2">';
        $output .= ($availability > 0) ? '<span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>'.__('Available').' ('.$availability.')' : '<span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>'.__('Not Available');
        $output .= '</span>';
        $output .= createButton($biblio_id, $biblio_detail['title']);
        $output .= '<div class="flex flex-wrap gap-1 mt-2">';
        $output .= $_authors_string;
        $output .= '</div>';
        $output .= '<p class="text-sm text-on-surface-variant mt-2 line-clamp-2 leading-relaxed">'.$notes.'</p>';
        $output .= '<div id="expand-'.$biblio_id.'" class="collapse py-2">'.$custom_field.'</div>';
        // Action buttons
        $output .= '<div class="flex flex-wrap gap-2 mt-3">';
        $output .= '<a class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-medium rounded-lg border border-gray-200 text-on-surface-variant hover:bg-primary/5 hover:text-primary transition-colors no-underline" href="'.$detail_url.'&MARC=true" target="_blank"><span class="material-symbols-outlined text-sm">download</span>'.__('MARC').'</a>';
        $output .= '<a class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-medium rounded-lg border border-gray-200 text-on-surface-variant hover:bg-primary/5 hover:text-primary transition-colors no-underline openPopUp citationLink" href="'.$cite_url.'" title="'.str_replace('{title}', substr($title, 0, 50), __('Citation for: {title}')).'" target="_blank"><span class="material-symbols-outlined text-sm">format_quote</span>'.__('Cite').'</a>';
        $output .= '</div>';
        $output .= '</div>'; // flex-1
        $output .= '</div>'; // flex gap-4
        if ($i > 0 && $expand) {
            $output .= '<div class="text-center mt-2"><a id="btn-expand-'.$biblio_id.'" class="inline-flex items-center gap-1 text-xs text-primary hover:text-primary-container no-underline py-1" data-toggle="collapse" href="#expand-'.$biblio_id.'" role="button"><span class="material-symbols-outlined text-sm">expand_more</span>'.__('More details').'</a></div>';
        }
        $output .= '</div>'; // p-4
        $output .= '</div>'; // card

    else:
        // Grid view
        $output .= '<div class="col-md-3 px-2 grid-item">';
        $output .= '<div class="bg-white rounded-2xl shadow-sm border border-emerald-900/5 overflow-hidden mb-4 hover:shadow-md transition-all group">';
        $__ = '__';
        $title_cite = str_replace('{title}', substr($title, 0, 50), __('Citation for: {title}'));
        $output .= '<div class="relative">';
        $output .= '<div class="aspect-[3/4] bg-surface-container flex items-center justify-center p-4">';
        $output .= '<img loading="lazy" src="'.$thumb_url.'" class="max-w-full max-h-full object-contain shadow-md rounded-lg img-thumbnail '.($availability > 0 ?: 'opacity-60').'" />';
        $output .= '</div>';
        // Availability badge
        $output .= '<span class="absolute top-2 right-2 '.$avail_bg.' '.$avail_color.' text-[10px] font-bold px-2 py-1 rounded-full backdrop-blur-sm">';
        $output .= ($availability > 0) ? __('Available') : __('Borrowed');
        $output .= '</span>';
        $output .= '</div>';
        $output .= '<div class="p-3">';
        $output .= '<a href="'.$detail_url.'" class="text-sm font-semibold text-on-surface hover:text-primary no-underline line-clamp-2 leading-tight block mb-1">'.$title.'</a>';
        $output .= '<div class="flex gap-1 mt-2">';
        $output .= '<a class="text-[10px] text-on-surface-variant hover:text-primary no-underline" href="'.$detail_url.'&MARC=true">MARC</a>';
        $output .= '<span class="text-gray-300">·</span>';
        $output .= '<a class="text-[10px] text-on-surface-variant hover:text-primary no-underline openPopUp citationLink" href="'.$cite_url.'">'.$__('Cite').'</a>';
        $output .= '<span class="text-gray-300">·</span>';
        $output .= '<a class="text-[10px] text-on-surface-variant hover:text-primary no-underline add-to-chart-button" data-biblio="'.$biblio_id.'" href="#">'.$__('Basket').'</a>';
        $output .= '</div>';
        $output .= '</div>';
        if ($availability < 1) {
            $output .= '<div class="px-3 pb-3"><span class="text-xs text-red-500 font-medium">'.__('Item Not Available').'</span></div>';
        }
        $output .= '</div>';
        $output .= '</div>';
    endif;

    return $output;
}

function getNotes($dbs, $biblio_id) {
    $query = $dbs->query('SELECT notes FROM biblio WHERE biblio_id = ' . $biblio_id);
    $data = $query->fetch_row();
    return addEllipsis($data[0], 400);
}

function addEllipsis($string, $length, $end='…') {
    if (strlen($string??'') > $length) {
        $length -= strlen($end);
        $string  = substr($string, 0, $length);
        $string .= $end;
    }
    return ($string);
}

function getAvailability($dbs, $biblio_id, $sysconf) {
    $_item_q = $dbs->query('SELECT COUNT(*) FROM item WHERE biblio_id='.$biblio_id);
    $_item_c = $_item_q->fetch_row();
    $_borrowed_q = $dbs->query('SELECT COUNT(*) FROM loan AS l INNER JOIN item AS i'
        .' ON l.item_code=i.item_code WHERE l.is_lent=1 AND l.is_return=0 AND i.biblio_id='.$biblio_id);
    $_borrowed_c = $_borrowed_q->fetch_row();
    return $_item_c[0]-$_borrowed_c[0];
}

function createButton(int $biblio_id, string $title) {
    $commentUrlCondition = (utility::isMemberLogin() ?
                                Url::getSlimsBaseUri('?p=show_detail&id=' . $biblio_id . '#comment') :
                                Url::getSlimsBaseUri('?p=member&destination=' . Url::getSlimsBaseUri('?p=show_detail&id=' . $biblio_id . '#comment')->encode()));
    list($comment,$bookmark,$share) = [__('Comment'), (in_array($biblio_id, $_SESSION['bookmark']??[]) ? __('Bookmarked') : __('Bookmark')),__('Share')];
    $setBookmarked = trim(isset($_SESSION['bookmark'][$biblio_id]) ? 'bg-emerald-50 text-emerald-700 rounded-lg' : 'text-on-surface-variant');
    return <<<HTML
    <div class="flex flex-wrap gap-1 text-xs mt-1">
        <a href="{$commentUrlCondition}" class="inline-flex items-center gap-1 px-2 py-1 rounded-lg hover:bg-primary/5 text-on-surface-variant no-underline transition-colors">
            <span class="material-symbols-outlined text-sm">chat_bubble_outline</span>{$comment}
        </a>
        <a href="javascript:void(0)" data-id="{$biblio_id}" class="bookMarkBook inline-flex items-center gap-1 px-2 py-1 rounded-lg hover:bg-primary/5 no-underline transition-colors {$setBookmarked}">
            <span class="material-symbols-outlined text-sm">bookmark</span>
            <label id="label-{$biblio_id}" class="m-0 cursor-pointer">{$bookmark}</label>
        </a>
        <a href="javascript:void(0)" data-id="{$biblio_id}" data-title="{$title}" data-toggle="modal" data-target="#mediaSocialModal" class="inline-flex items-center gap-1 px-2 py-1 rounded-lg hover:bg-primary/5 text-on-surface-variant no-underline transition-colors">
            <span class="material-symbols-outlined text-sm">share</span>{$share}
        </a>
    </div>
    HTML;
}
