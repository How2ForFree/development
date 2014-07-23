<?php
/**
 * @package WordPress
 * @subpackage Starkers
 */
?>

    </div> <!-- end .mainmargin -->
    <div id="footer">
    	<div class="margin25px">
            <div id="footer_left" class="footer_column">
            	<ul>
				<?php dynamic_sidebar(2); ?>
                </ul>
            </div>
            <div class="footer_column">
                <ul>
                <?php dynamic_sidebar(3); ?>
                </ul>
            </div>
            <div id="footer_middle_column" class="footer_column">
                <ul>
                <?php dynamic_sidebar(4); ?>
                </ul>
            </div>
            <div class="footer_column">
                <ul>
                <?php dynamic_sidebar(5); ?>
                </ul>
            </div>
    	</div>
    	<div class="copyright"><?php echo get_option('theme_copyright'); ?></div>
    </div>

<?php wp_footer(); ?>
<?php if (get_option('agent_google')): ?>
	<script type="text/javascript">
    var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
    document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
    </script>
    <script type="text/javascript">
    try {
    var pageTracker = _gat._getTracker("<?php echo get_option('agent_google'); ?>");
    pageTracker._trackPageview();
    } catch(err) {} </script>
<?php endif; ?>
</body>

</html>