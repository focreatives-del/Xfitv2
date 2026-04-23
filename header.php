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
                    <li><a href="<?php echo home_url('/'); ?>" class="active">Home</a></li>
                    <li><a href="<?php echo home_url('/about-us'); ?>">About us</a></li>
                    <li><a href="<?php echo home_url('/index.php/workout/'); ?>">Workout plans</a></li>
                    <li><a href="<?php echo home_url('/diet-plan'); ?>">Diet plans</a></li>
                    <li><a href="<?php echo home_url('/my-workout-plan'); ?>">My program</a></li>
                </ul>
            </nav>

            <div class="header-actions">
                <a href="#" class="btn-pill btn-bmi">BMI</a>
                <a href="#" class="btn-pill btn-profile">Profile</a>
            </div>

        </div>
    </header>
