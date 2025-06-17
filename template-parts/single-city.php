<?php 

class Single_City_Widget extends \Elementor\Widget_Base {
    public function get_name() {
        return 'single_city';
    }

    public function get_title() {
        return __('Single City', 'plugin-name');
    }

    public function get_icon() {
        return 'eicon-single-post';
    }

    public function get_categories() {
        return ['general'];
    }

    protected function render() {
        if (is_singular('city')) {
            echo '<div class="single-city">';
            echo '<h1>' . get_the_title() . '</h1>';
            echo get_the_post_thumbnail();
            echo '<div class="content">' . get_the_content() . '</div>';
            echo '</div>';
        } else {
            echo '<p>' . __('This is not a city page.', 'plugin-name') . '</p>';
        }
    }
}
\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Single_City_Widget());

