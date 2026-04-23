<?php
# Modern Search Form
# Preserves Vue.js bindings and CSRF handling

if ($opac->invalid_token) {
    //die($opac->error('invalid CSRF token'));
}
?>

<div class="search-modern" id="search-wraper" xmlns:v-bind="http://www.w3.org/1999/xhtml">
    <div class="max-w-3xl mx-auto px-4 relative">
        <div class="relative group">
            <form action="index.php" method="get" @submit.prevent="searchSubmit">
                <input type="hidden" name="search" value="search">
                <div class="absolute inset-y-0 left-4 flex items-center pointer-events-none text-outline">
                    <span class="material-symbols-outlined">search</span>
                </div>
                <input ref="keywords" value="<?= htmlentities(getQuery('keywords')) ?>" v-model.trim="keywords"
                       @focus="searchOnFocus" @blur="searchOnBlur" type="text" id="search-input"
                       name="keywords" autocomplete="off"
                       class="w-full pl-12 pr-32 py-4 bg-surface-container-lowest border-none rounded-xl shadow-[0_4px_20px_rgba(45,106,79,0.08)] focus:ring-2 focus:ring-primary focus:outline-none transition-all text-on-surface placeholder:text-outline/60"
                       placeholder="<?= __('Search title, author, or ISBN...');?>"/>
                <button type="submit" name="search" value="search"
                        class="absolute right-2 top-2 bottom-2 px-6 bg-primary text-on-primary font-semibold text-xs uppercase tracking-wider rounded-lg hover:bg-primary-container hover:text-on-primary-container transition-colors">
                    <?= __('Search'); ?>
                </button>
            </form>
        </div>

        <!-- Advanced search panel (Vue-driven) -->
        <transition name="slide-fade">
            <div v-if="show" class="absolute left-4 right-4 top-full mt-3 bg-white rounded-xl shadow-xl border border-gray-100 p-5 z-50" id="advanced-wraper"
                 v-click-outside="hideSearch">
                <div class="flex items-center justify-between mb-3">
                    <p class="text-xs font-semibold text-on-surface-variant uppercase tracking-wider m-0">
                        <?= __('Search by :');?>
                    </p>
                    <button @click="hideSearch" class="p-1 rounded-full hover:bg-error/10 text-error transition-colors">
                        <span class="material-symbols-outlined text-lg">close</span>
                    </button>
                </div>
                <div class="flex flex-wrap gap-2">
                    <a v-bind:class="{'bg-primary text-white': searchBy === 'keywords', 'bg-surface-container-high text-on-surface': searchBy !== 'keywords' }"
                       @click="searchOnClick('keywords')" class="px-4 py-2 rounded-lg text-sm font-medium cursor-pointer transition-colors no-underline"><?= __('ALL')?></a>
                    <a v-bind:class="{'bg-primary text-white': searchBy === 'author', 'bg-surface-container-high text-on-surface': searchBy !== 'author' }"
                       @click="searchOnClick('author')" class="px-4 py-2 rounded-lg text-sm font-medium cursor-pointer transition-colors no-underline"><?= __('Author');?></a>
                    <a v-bind:class="{'bg-primary text-white': searchBy === 'subject', 'bg-surface-container-high text-on-surface': searchBy !== 'subject' }"
                       @click="searchOnClick('subject')" class="px-4 py-2 rounded-lg text-sm font-medium cursor-pointer transition-colors no-underline"><?= __('Subject');?></a>
                    <a v-bind:class="{'bg-primary text-white': searchBy === 'isbn', 'bg-surface-container-high text-on-surface': searchBy !== 'isbn' }"
                       @click="searchOnClick('isbn')" class="px-4 py-2 rounded-lg text-sm font-medium cursor-pointer transition-colors no-underline"><?= __('ISBN/ISSN');?></a>
                    <span class="px-3 py-2 text-xs text-outline font-medium uppercase"><?= __('OR TRY'); ?></span>
                    <a class="px-4 py-2 rounded-lg text-sm font-medium bg-secondary/10 text-secondary cursor-pointer hover:bg-secondary/20 transition-colors no-underline" data-toggle="modal" data-target="#adv-modal"><?= __('Advanced Search');?></a>
                </div>
                <div v-if="lastKeywords.length > 0" class="mt-4 pt-3 border-t border-gray-100">
                    <p class="text-xs font-semibold text-on-surface-variant uppercase tracking-wider mb-2"><?= __('Last search:');?></p>
                    <a :href="`index.php?${tmpObj[k].searchBy}=${tmpObj[k].text}&search=search`"
                       class="flex items-center justify-between py-2 text-sm text-on-surface hover:text-primary no-underline transition-colors"
                       v-for="k in lastKeywords" :key="k">
                        <span class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-outline text-sm">schedule</span>
                            <span class="italic">{{tmpObj[k].text}}</span>
                        </span>
                        <span class="material-symbols-outlined text-outline text-sm">chevron_right</span>
                    </a>
                </div>
            </div>
        </transition>
    </div>
</div>
