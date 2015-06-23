<?php
$titleArray = array(__('Scripto'), __('Transcribe Page'));

//editor coolness
queue_js_file('editor-bar');
queue_css_url('../../../../mwiki/extensions/TEITags/css/ext.teitags.css');

//seadragon
queue_js_file('openseadragon.min');

//load the header
echo common('header-transc');

//set the page id etc etc
    $page_id = $this->doc->getId();
    set_current_record('item',get_record_by_id('item', $page_id));
    $collection = get_collection_for_item();
    $collection_link = link_to_collection_for_item();


//load the JS for scripto
?>
        <!-- right column (image)-->
      <div class="span7">
          <!-- openseadragon viewer ready for iIIIF -->
          <div id="image-viewer" style="width: 100%; height: 650px;" ></div>
      </div><!-- end of right column -->

      <!-- left column (transcription) -->
      <div class="span5">
        <!--breadcrumb-->
        <ul class="breadcrumb">
          <li><?php echo link_to_home_page('Home'); ?><span class="divider">/<span></li>
          <li><?php echo link_to_collection_for_item($collection->name, array('id' => 'item-collection-link',)); ?><span class="divider">/<span></li>
          <li><?php echo link_to_item();?><span class="divider">/<span></li>
          <li class="active"><?php echo __('Transcribe') ?></li>
        </ul>

        <?php echo flash(); ?>
        <div class="row-fluid">
          <div class="span12">
            <h3><?php echo $this->doc->getPageName(); ?></h3>
          </div>
        </div>
        <div class="row-fluid"><!-- pagination -->
          <div class="span4">
            <p>Image <?php echo html_escape($this->paginationUrls['current_page_number']); ?> of <?php echo html_escape($this->paginationUrls['number_of_pages']); ?>
          </div>
          <div class="span3 offset1">
              <p>
                <?php if (isset($this->paginationUrls['previous'])) {
                  echo '<a href="' . html_escape($this->paginationUrls['previous']) . '">&#171; ' .  __('previous page') . '</a>';
                } ?>
              </p>
          </div>
          <div class="span1">
            <p>
              <?php if (isset($this->paginationUrls['previous']) && isset($this->paginationUrls['next'])) {
                echo ' | ';
              } ?>
            </p>
          </div>
          <div class="span3">
            <p>
              <?php
              if (isset($this->paginationUrls['next'])) {
                echo '<a href="' . html_escape($this->paginationUrls['next']) . '">' .  __('next page') . ' &#187;</a>';
              }
              ?>
            </p>
          </div>
        </div>
        <div class="row-fluid">
          <!-- transcription -->
          <div class="span12 scripto-transcription rounded">
          <?php if ($this->doc->canEditTranscriptionPage()): ?>
              <?php if ($this->doc->isProtectedTranscriptionPage()): ?>
                    <p>  <strong>This transcription is complete!</strong> </p>
              <?php else: ?>
                <!-- editor buttons -->
                <p align="center">
                  <button id ="head" class="btn btn-mini btn-primary" type="button">Heading</button>
                  <button id ="lb" class="btn btn-mini btn-primary" type="button">Line break</button>
                  <button id ="add" class="btn btn-mini btn-primary" type="button">Addition</button>
                  <button id ="del" class="btn btn-mini btn-primary" type="button">Deletion</button>
                  <button id ="subst" class="btn btn-mini btn-primary" type="button">Substitution</button>
                  <button id ="gap" class="btn btn-mini btn-primary" type="button">Illegible</button>
                  <button id ="sic" class="btn btn-mini btn-primary" type="button">SIC</button>
                </p><p align="center">
                  <button id ="note" class="btn btn-mini btn-info" type="button">Note</button>
                  <button id ="subs" class="btn btn-mini btn-info" type="button">Superscript</button>
                  <button id ="unclear" class="btn btn-mini btn-info" type="button">Unclear</button>
                  <button id ="foreign" class="btn btn-mini btn-info" type="button">Foreign</button>
                  <button id ="und" class="btn btn-mini btn-info" type="button">Underline</button>
                  <button id ="person" class="btn btn-mini btn-success" type="button">Person</button>
                  <button id ="place" class="btn btn-mini btn-success" type="button">Place</button>
                </p>
                <!-- text area -->
                <?php echo $this->formTextarea('scripto-transcription-page-wikitext', $this->doc->getTranscriptionPageWikitext(), array('style'=> 'height:200px;', 'class'=> 'span12')); ?>
                <p><?php echo $this->formButton('scripto-transcription-page-edit', __('Save and update'), array('style' => 'display:inline; float:none;')); ?></p>
             <?php endif; ?>


          <?php else: ?>
              <p><?php echo __('Please login to transcribe this page.'); ?></p>
          <?php endif; ?>
          </div><!-- #scripto-transcription -->
        </div>

        <div class="row-fluid top-buffer">
          <div class="span12" id="scripto-transcription-page-html">
            <?php echo $this->transcriptionPageHtml; ?>

            <?php if ($this->scripto->canProtect()): ?>
              <p>
                [<a href="<?php echo html_escape($this->doc->getTranscriptionPageMediawikiUrl()); ?>"><?php echo __('wiki'); ?></a>]
            <?php endif; ?>
                [<a href="<?php echo html_escape(url(array('item-id' => $this->doc->getId(), 'file-id' => $this->doc->getPageId(), 'namespace-index' => 0), 'scripto_history')); ?>"><?php echo __('history'); ?></a>]</strong>
              </p>
          </div>
        </div>




        <div class="span12">
            <?php if ($this->scripto->isLoggedIn()): ?><?php echo $this->formButton('scripto-page-watch'); ?> <?php endif; ?>
              <?php if ($this->scripto->canProtect()): ?><?php echo $this->formButton('scripto-transcription-page-protect'); ?> <?php endif; ?>
              <?php if ($this->scripto->canExport()): ?><?php echo $this->formButton('scripto-transcription-page-import', __('Import page'), array('style' => 'display:inline; float:none;')); ?><?php endif; ?>
                <?php if ($this->scripto->canExport()): ?><?php echo $this->formButton('scripto-transcription-document-import', __('Import document'), array('style' => 'display:inline; float:none;')); ?><?php endif; ?>


            </div>





      </div><!--end of left column-->


    </div><!-- end of main row -->
    <div class="row-fluid"><!--full width row under transcribe -->
      <!-- discussion -->
      <div id="scripto-talk">
          <?php if ($this->doc->canEditTalkPage()): ?>
          <div id="scripto-talk-edit">
              <div><?php echo $this->formTextarea('scripto-talk-page-wikitext', $this->doc->getTalkPageWikitext(), array('cols' => '76', 'rows' => '16')); ?></div>
              <div>
                  <?php echo $this->formButton('scripto-talk-page-edit', __('Edit discussion'), array('style' => 'display:inline; float:none;')); ?>
              </div>
              <p><a href="http://www.mediawiki.org/wiki/Help:Formatting" target="_blank"><?php echo __('wiki formatting help'); ?></a></p>
          </div><!-- #scripto-talk-edit -->
          <?php else: ?>
          <p><?php echo __('You don\'t have permission to discuss this page.'); ?></p>
          <?php endif; ?>
          <h2><?php echo __('Current Page Discussion'); ?>
          <?php if ($this->doc->canEditTalkPage()): ?> [<a href="#" id="scripto-talk-edit-show"><?php echo __('edit'); ?></a>]<?php endif; ?>
          <?php if ($this->scripto->canProtect()): ?> [<a href="<?php echo html_escape($this->doc->getTalkPageMediawikiUrl()); ?>"><?php echo __('wiki'); ?></a>]<?php endif; ?>
          [<a href="<?php echo html_escape(url(array('item-id' => $this->doc->getId(), 'file-id' => $this->doc->getPageId(), 'namespace-index' => 1), 'scripto_history')); ?>"><?php echo __('history'); ?></a>]</h2>
          <div>
              <?php if ($this->scripto->canProtect()): ?><?php echo $this->formButton('scripto-talk-page-protect'); ?> <?php endif; ?>
          </div>
          <div id="scripto-talk-page-html"><?php echo $this->talkPageHtml; ?></div>
      </div><!-- #scripto-talk -->


      <div id="options">
        <ul class="nav">
        <?php if ($this->scripto->isLoggedIn()): ?>
            <li><a href="<?php echo html_escape(url('scripto/watchlist')); ?>"><?php echo __('Your watchlist'); ?></a> </li>
        <?php endif; ?>
            <li><a href="<?php echo html_escape(url('scripto/recent-changes')); ?>"><?php echo __('Recent changes'); ?></a></li>
            <li><a href="<?php echo html_escape(url(array('controller' => 'items', 'action' => 'show', 'id' => $this->doc->getId()), 'id')); ?>"><?php echo __('View item'); ?></a></li>
            <li><a href="<?php echo html_escape(url(array('controller' => 'files', 'action' => 'show', 'id' => $this->doc->getPageId()), 'id')); ?>"><?php echo __('View file'); ?></a></li>
        </ul>
      </div><!-- end options -->



<?php
//this needs to be somewhere else!
$OrigImg = file_display_url($file,$format='original');
$FullImg = file_display_url($file,$format='fullsize');
$ThumbImg = file_display_url($file,$format='thumbnail');
//get image sizes
$OrigSize = ScriptoPlugin::getImageSize($OrigImg);
$FullSize = ScriptoPlugin::getImageSize($FullImg);
$ThumbSize = ScriptoPlugin::getImageSize($ThumbImg);
?>

<!--javascript for imageviewer div -->
<script type="text/javascript">
  var viewer = OpenSeadragon({
    id: "image-viewer",
    prefixUrl: "<?php echo public_url('themes/Scribe/images'); ?>/",
    preserveViewport: true,
    visibilityRatio:    1,
    minZoomLevel:       1,
    defaultZoomLevel:   0,
    showNavigator: true,
    tileSources: {
      type: 'legacy-image-pyramid',
      levels: [{
        url: '<?php echo $OrigImg; ?>',
        height: '<?php echo $OrigSize['height']; ?>',
        width: '<?php echo $OrigSize['width']; ?>'
      },{
        url: '<?php echo $FullImg; ?>',
        height: '<?php echo $FullSize['height']; ?>',
        width: '<?php echo $FullSize['width']; ?>'
      },{
          url: '<?php echo $ThumbImg; ?>',
          height: '<?php echo $ThumbSize['height']; ?>',
          width: '<?php echo $ThumbSize['width']; ?>'
        }]
    }
  });
</script>
<script type="text/javascript">
jQuery(document).ready(function() {


    // Handle edit transcription page.
    jQuery('#scripto-transcription-page-edit').click(function() {
        jQuery('#scripto-transcription-page-edit').
            prop('disabled', true).
            text('<?php echo __('Saving transcription...'); ?>');
        jQuery.post(
            <?php echo js_escape(url('scripto/index/page-action')); ?>,
            {
                page_action: 'edit',
                page: 'transcription',
                item_id: <?php echo js_escape($this->doc->getId()); ?>,
                file_id: <?php echo js_escape($this->doc->getPageId()); ?>,
                wikitext: jQuery('#scripto-transcription-page-wikitext').val()
            },
            function(data) {
                jQuery('#scripto-transcription-page-edit').
                    prop('disabled', false).
                    text('<?php echo __('Save transcription'); ?>');
                jQuery('#scripto-transcription-page-html').html(data);
            }
        );
    });

    // Handle edit talk page.
    jQuery('#scripto-talk-page-edit').click(function() {
        jQuery('#scripto-talk-page-edit').
            prop('disabled', true).
            text('<?php echo __('Editing discussion...'); ?>');
        jQuery.post(
            <?php echo js_escape(url('scripto/index/page-action')); ?>,
            {
                page_action: 'edit',
                page: 'talk',
                item_id: <?php echo js_escape($this->doc->getId()); ?>,
                file_id: <?php echo js_escape($this->doc->getPageId()); ?>,
                wikitext: jQuery('#scripto-talk-page-wikitext').val()
            },
            function(data) {
                jQuery('#scripto-talk-page-edit').
                    prop('disabled', false).
                    text('<?php echo __('Edit discussion'); ?>');
                jQuery('#scripto-talk-page-html').html(data);
            }
        );
    });


    <?php if ($this->scripto->isLoggedIn()): ?>

    // Handle default un/watch page.
    <?php if ($this->doc->isWatchedPage()): ?>
    jQuery('#scripto-page-watch').
        data('watch', true).
        text('<?php echo __('Unwatch page'); ?>').
        css('float', 'none');
    <?php else: ?>
    jQuery('#scripto-page-watch').
        data('watch', false).
        text('<?php echo __('Watch page'); ?>').
        css('float', 'none');
    <?php endif; ?>

    // Handle un/watch page.
    jQuery('#scripto-page-watch').click(function() {
        if (!jQuery(this).data('watch')) {
            jQuery(this).prop('disabled', true).text('<?php echo __('Watching page...'); ?>');
            jQuery.post(
                <?php echo js_escape(url('scripto/index/page-action')); ?>,
                {
                    page_action: 'watch',
                    page: 'transcription',
                    item_id: <?php echo js_escape($this->doc->getId()); ?>,
                    file_id: <?php echo js_escape($this->doc->getPageId()); ?>
                },
                function(data) {
                    jQuery('#scripto-page-watch').
                        data('watch', true).
                        prop('disabled', false).
                        text('<?php echo __('Unwatch page'); ?>');
                }
            );
        } else {
            jQuery(this).prop('disabled', true).text('<?php echo __('Unwatching page...'); ?>');
            jQuery.post(
                <?php echo js_escape(url('scripto/index/page-action')); ?>,
                {
                    page_action: 'unwatch',
                    page: 'transcription',
                    item_id: <?php echo js_escape($this->doc->getId()); ?>,
                    file_id: <?php echo js_escape($this->doc->getPageId()); ?>
                },
                function(data) {
                    jQuery('#scripto-page-watch').
                        data('watch', false).
                        prop('disabled', false).
                        text('<?php echo __('Watch page'); ?>');
                }
            );
        }
    });

    <?php endif; // end isLoggedIn() ?>

    <?php if ($this->scripto->canProtect()): ?>

    // Handle default un/protect transcription page.
    <?php if ($this->doc->isProtectedTranscriptionPage()): ?>
    jQuery('#scripto-transcription-page-protect').
        data('protect', true).
        text('<?php echo __('Unprotect page'); ?>').
        css('float', 'none');
    <?php else: ?>
    jQuery('#scripto-transcription-page-protect').
        data('protect', false).
        text('<?php echo __('Protect page'); ?>').
        css('float', 'none');
    <?php endif; ?>

    // Handle un/protect transcription page.
    jQuery('#scripto-transcription-page-protect').click(function() {
        if (!jQuery(this).data('protect')) {
            jQuery(this).prop('disabled', true).text('<?php echo __('Protecting...'); ?>');
            jQuery.post(
                <?php echo js_escape(url('scripto/index/page-action')); ?>,
                {
                    page_action: 'protect',
                    page: 'transcription',
                    item_id: <?php echo js_escape($this->doc->getId()); ?>,
                    file_id: <?php echo js_escape($this->doc->getPageId()); ?>,
                    wikitext: jQuery('#scripto-transcription-page-wikitext').val()
                },
                function(data) {
                    jQuery('#scripto-transcription-page-protect').
                        data('protect', true).
                        prop('disabled', false).
                        text('<?php echo __('Unprotect page'); ?>');
                }
            );
        } else {
            jQuery(this).prop('disabled', true).text('<?php echo __('Unprotecting page...'); ?>');
            jQuery.post(
                <?php echo js_escape(url('scripto/index/page-action')); ?>,
                {
                    page_action: 'unprotect',
                    page: 'transcription',
                    item_id: <?php echo js_escape($this->doc->getId()); ?>,
                    file_id: <?php echo js_escape($this->doc->getPageId()); ?>
                },
                function(data) {
                    jQuery('#scripto-transcription-page-protect').
                        data('protect', false).
                        prop('disabled', false).
                        text('<?php echo __('Protect page'); ?>');
                }
            );
        }
    });

    // Handle default un/protect talk page.
    <?php if ($this->doc->isProtectedTalkPage()): ?>
    jQuery('#scripto-talk-page-protect').
        data('protect', true).
        text('<?php echo __('Unprotect page'); ?>').
        css('float', 'none');
    <?php else: ?>
    jQuery('#scripto-talk-page-protect').
        data('protect', false).
        text('<?php echo __('Protect page'); ?>').
        css('float', 'none');
    <?php endif; ?>

    // Handle un/protect talk page.
    jQuery('#scripto-talk-page-protect').click(function() {
        if (!jQuery(this).data('protect')) {
            jQuery(this).
                prop('disabled', true).
                text('<?php echo __('Protecting page...'); ?>');
            jQuery.post(
                <?php echo js_escape(url('scripto/index/page-action')); ?>,
                {
                    page_action: 'protect',
                    page: 'talk',
                    item_id: <?php echo js_escape($this->doc->getId()); ?>,
                    file_id: <?php echo js_escape($this->doc->getPageId()); ?>
                },
                function(data) {
                    jQuery('#scripto-talk-page-protect').
                        data('protect', true).
                        prop('disabled', false).
                        text('<?php echo __('Unprotect page'); ?>');
                }
            );
        } else {
            jQuery(this).prop('disabled', true).text('<?php echo __('Unprotecting page...'); ?>');
            jQuery.post(
                <?php echo js_escape(url('scripto/index/page-action')); ?>,
                {
                    page_action: 'unprotect',
                    page: 'talk',
                    item_id: <?php echo js_escape($this->doc->getId()); ?>,
                    file_id: <?php echo js_escape($this->doc->getPageId()); ?>
                },
                function(data) {
                    jQuery('#scripto-talk-page-protect').
                        data('protect', false).
                        prop('disabled', false).
                        text('<?php echo __('Protect page'); ?>');
                }
            );
        }
    });

    <?php endif; // end canProtect() ?>
    <?php if ($this->scripto->canExport()): ?>

    jQuery('#scripto-transcription-page-import').click(function() {
        jQuery(this).prop('disabled', true).text('<?php echo __('Importing page...'); ?>');
        jQuery.post(
            <?php echo js_escape(url('scripto/index/page-action')); ?>,
            {
                page_action: 'import-page',
                page: 'transcription',
                item_id: <?php echo js_escape($this->doc->getId()); ?>,
                file_id: <?php echo js_escape($this->doc->getPageId()); ?>
            },
            function(data) {
                jQuery('#scripto-transcription-page-import').
                    prop('disabled', false).
                    text('<?php echo __('Import page'); ?>');
            }
        );
    });

    jQuery('#scripto-transcription-document-import').click(function() {
        jQuery(this).prop('disabled', true).text('<?php echo __('Importing document...'); ?>');
        jQuery.post(
            <?php echo js_escape(url('scripto/index/page-action')); ?>,
            {
                page_action: 'import-document',
                page: 'transcription',
                item_id: <?php echo js_escape($this->doc->getId()); ?>,
                file_id: <?php echo js_escape($this->doc->getPageId()); ?>
            },
            function(data) {
                jQuery('#scripto-transcription-document-import').
                    prop('disabled', false).
                    text('<?php echo __('Import document'); ?>');
            }
        );
    });

    <?php endif; // end canExport() ?>
});
</script>
<?php
//load the footer
echo common('footer-transc');

?>
