<?php
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

?>
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
        <h2><?php if ($this->doc->getTitle()): ?><?php echo $this->doc->getTitle(); ?><?php else: ?><?php echo __('Untitled Document'); ?><?php endif; ?></h2>
        
        <h3><?php echo $this->doc->getPageName(); ?></h3>

        <div>
            <div><strong><?php echo metadata($this->file, array('Dublin Core', 'Title')); ?></strong></div>
            <div>image <?php echo html_escape($this->paginationUrls['current_page_number']); ?> of <?php echo html_escape($this->paginationUrls['number_of_pages']); ?></div>
        </div>

      </div><!--end of left column-->

      <!-- right column (image)-->
      <div class="span7">

        <div id="image-viewer" style="width: 100%; height: 500px;" ></div>


      </div><!-- end of right column -->

</article>

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
<?php
//load the footer
echo common('footer-transc');

?>
