        </div><!-- end of main page structure (row) -->

        <!-- probably needs a row here -->

      </article>
      <footer id="footer">
        <div class="row-fluid">
          <p><?php echo get_theme_option('Footer Text'); ?></p>
        </div>
        <?php fire_plugin_hook('public_footer', array('view'=>$this)); ?>
      </footer>
    </div><!--end of container-->
</body>
</html>
