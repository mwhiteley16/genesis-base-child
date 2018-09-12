<?php
/*
Template Name: Home Page Template
*/
get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post();?>

HOME PAGE TEMPLATE

<?php endwhile; endif; ?>

<?php get_footer(); ?>
