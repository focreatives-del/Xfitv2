    <footer id="colophon" class="site-footer">
        <div class="container footer-container glass-panel">
            <div class="footer-columns">
                <div class="footer-col branding">
                    <h3><?php bloginfo( 'name' ); ?></h3>
                    <p>Build Future-Ready Fitness.</p>
                </div>
                <div class="footer-col links">
                    <h4>Quick Links</h4>
                    <?php
                    wp_nav_menu(
                        array(
                            'theme_location' => 'footer',
                            'fallback_cb'    => false,
                        )
                    );
                    ?>
                </div>
                <div class="footer-col info">
                    <h4>Contact Us</h4>
                    <p>contact@trainopro.com</p>
                    <p>+1 234 567 8900</p>
                </div>
            </div>
            <div class="site-info">
                &copy; <?php echo date("Y"); ?> <?php bloginfo( 'name' ); ?>. All rights reserved.
            </div><!-- .site-info -->
        </div>
    </footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>
