<?php
/**
 * Modern News Template
 */

function news_list_tpl($title, $path, $date, $summary) {
  global $sysconf;
  if (isset($_COOKIE['select_lang'])) $sysconf['default_lang'] = trim(strip_tags($_COOKIE['select_lang']));
  ?>

  <div class="bg-white rounded-2xl shadow-sm border border-emerald-900/5 hover:shadow-md transition-all mb-4 overflow-hidden">
      <div class="p-5">
          <div class="flex items-center gap-2 text-sm text-on-surface-variant mb-2">
              <span class="material-symbols-outlined text-sm text-primary">schedule</span>
              <?= \Carbon\Carbon::parse($date)->locale($sysconf['default_lang'])->isoFormat('dddd, LL') ?>
          </div>
          <h3 class="text-lg font-semibold text-on-surface mb-3 leading-tight"><?php echo $title ?></h3>
          <p class="text-sm text-on-surface-variant leading-relaxed mb-4"><?php echo $summary ?>...</p>
          <div class="flex justify-end">
              <a class="inline-flex items-center gap-1 px-4 py-2 bg-primary text-white text-sm font-medium rounded-lg hover:bg-primary-container transition-colors no-underline" href="<?php echo SWB.'index.php?p='.$path ?>">
                  <?php echo __('Read More') ?>
                  <span class="material-symbols-outlined text-sm">arrow_forward</span>
              </a>
          </div>
      </div>
  </div>

  <?php
}