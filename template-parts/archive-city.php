<?php


class City_Archive_Widget extends \Elementor\Widget_Base {
    public function get_name() {
        return 'city_archive';
    }

    public function get_title() {
        return __('City Archive', 'plugin-name');
    }

    public function get_icon() {
        return 'eicon-post-list';
    }

    public function get_categories() {
        return ['general'];
    }

    protected function render() {
        $query = new WP_Query([
            'post_type' => 'city',
            'posts_per_page' => -1,
        ]);

        if ($query->have_posts()) {
            echo '<div class="city-archive">';
            while ($query->have_posts()) {
                $query->the_post();
                echo '<div class="city-item">';
                echo '<h2><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2>';
                echo get_the_post_thumbnail();
                echo '</div>';
            }
            echo '</div>';
            wp_reset_postdata();
        } else {
            echo '<p>' . __('No cities found.', 'plugin-name') . '</p>';
        }
    }
}
\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new City_Archive_Widget());



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