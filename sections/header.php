<div class="header-logo-wrap">
     <a href="<?php echo get_home_url(); ?>">LOGO GOES HERE</a>
</div>

<button class="mobile-menu-toggle">
     <div></div>
     <div></div>
     <div></div>
</button>

<script>
jQuery(document).ready(function() {
     jQuery('button.mobile-menu-toggle').click(function() {
         jQuery(this).toggleClass('active');
         jQuery('.nav-primary').slideToggle();
     });
});
</script>
