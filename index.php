<?php include 'conf.inc.php'; ?>
<!DOCTYPE html>
<html lang="en" class="html">
    <head>
        <?php include 'includes/metas_and_favicons.php'; ?>
        <!--Stylesheets-->
        <?php $webpage->load_top_css(); ?>
        <!--Scripts-->
        <?php $webpage->load_top_scripts(); ?>

        <title><?php echo $webpage->page_name(); ?></title>
    </head>

    <body>
        <div class="toggle-overlay"></div>
        <!--Navigation-->
        <?php include 'includes/responsive_navigation.php'; ?>
        <!--End Of Navigation-->

        <div id="header" class="header">
            <div id="header-nav" class="header-nav">
                <div class="social-links">
                    <?php $webpage->social_facebook("link-fb", "", "Facebook"); ?>
                    <?php $webpage->social_twitter("link-twitter", "", "Twitter"); ?>
                </div>
                <div id="logo" class="logo">
                    <a href="<?php echo $webpage->company_website(); ?>" title="<?php echo $webpage->company_name(); ?>"></a>
                </div>
                <div id="main-menu" class="main-menu">
                    <?php include('includes/main_menu.php'); ?>
                </div>
            </div>
        </div>

        <!--Begin page content -->
        <div class="container">
            <?php include 'includes/content.php'; ?>
        </div>
        <!--Social floater-->
        <?php include 'includes/floater.php'; ?>
        <!--Footer-->
        <?php include 'includes/footer.php'; ?>
        <!--Scripts-->
        <?php $webpage->load_bottom_scripts(); ?>
    </body>
</html>