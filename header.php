<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css"
          integrity="sha512-NhSC1YmyruXifcj/KFRWoC561YpHpc5Jtzgvbuzx5VozKpWvQ+4nXhPdFgmx8xqexRcpAglTj9sIBWINXa8x5w=="
          crossorigin="anonymous"/>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<header role="banner" class="u-margin-bottom-40">
    <div class="c-header">
        <div class="o-container u-flex u-align-justify u-align-middle">
            <div class="c-header__logo">
				<?php if ( has_custom_logo() ) {
					the_custom_logo();
				} else { ?>
                    <a class="c-header__blogname"
                       href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html( bloginfo( 'name' ) ); ?></a>
				<?php } ?>
            </div>
			<?php get_search_form( true ); ?>
        </div>
    </div>
</header>

<div id="content">
