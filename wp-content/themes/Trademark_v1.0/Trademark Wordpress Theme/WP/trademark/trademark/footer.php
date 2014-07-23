<?php $bottom_text = trim(get_option('bottom_text')); ?>
              <?php if ( !empty( $bottom_text ) ) : ?>
                  <!-- FOOTER MAIN -->
                  <div id="main-footer">
                    <?php echo stripslashes($bottom_text); ?>
                  </div><!-- /#main-footer -->                  
              <?php endif; ?>
            </div><!-- /#main -->                        
        </div><!-- #page-wrapper -->
        
        <!-- FOOTER -->
        <div id="footer">
            <div id="copyright"><a href="#" title="">yoursite</a>
                <?php if ( get_option( 'footer_text' ) ): ?>
                    <?php echo stripslashes( get_option( 'footer_text' ) ); ?>
                <?php endif; ?>
            </div><!-- #copyright -->
            
            <div id="navigation-footer" class="clearfix">
                <?php wp_nav_menu( array('theme_location' => 'footer', 'after' => '<span class="sep">|</span>', 'container' => '') ); ?>
            </div><!-- #navigation-footer -->
        </div><!-- /#footer -->
        
    </div><!-- /#page -->
</div><!-- /#back -->

<?php wp_footer(); ?>

<?php $ga_code = get_option('ga_code'); ?>
<?php if ($ga_code != ''): ?>
    <script type="text/javascript">
      var _gaq = _gaq || [];
      _gaq.push(['_setAccount', '<?php echo $ga_code; ?>']);
      _gaq.push(['_trackPageview']);

      (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
      })();
    </script>
<?php endif; ?>
</body>
</html>