<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">
    <header id="masthead" class="site-header">
        <div class="container header-container">
            
            <div class="site-branding">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="logo-text">LOGO</a>
            </div>

            <nav id="site-navigation" class="main-navigation">
                <ul>
                    <li><a href="#" class="active">Home</a></li>
                    <li><a href="#">About us</a></li>
                    <li><a href="#">Workout plans</a></li>
                    <li><a href="#">Diet plans</a></li>
                    <li><a href="#">My program</a></li>
                </ul>
            </nav>

            <div class="header-actions">
                <a href="#" class="btn-pill btn-bmi">BMI</a>
                <a href="#" class="btn-pill btn-profile">Profile</a>
            </div>

        </div>
    </header>
