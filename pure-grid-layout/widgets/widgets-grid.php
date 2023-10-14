<?php
class Grid_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'grid-widget';
    }

    public function get_title() {
        return esc_html__('Grid Widget', 'elementor-widget');
    }

    public function get_icon() {
        return 'eicon-pojome';
    }

    public function get_categories() {
        return ['general'];
    }

    public function get_keywords() {
        return ['grid', 'widget'];
    }

    public function register_controls() {
        $this->start_controls_section(
            'content_section_title',
            [
                'label' => esc_html__('Title', 'elementor-widget'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'posts_limit',
            [
                'type' => \Elementor\Controls_Manager::NUMBER,
                'label' => esc_html__('Post Limit', 'elementor-widget'),
                'default' => 6,
                'placeholder' => esc_html__('6', 'elementor-widget'),
            ]
        );
        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Title Color', 'elementor-widget'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ultimate-post-kit-fly-wrap .upk-fly-grid-wrapper .upk-fly-grid-item .upk-fly-grid-item-box .upk-fly-content-box .upk-content-inner .upk-fly-title .upk-title' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'title',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label' => esc_html__('Title', 'elementor-widget'),
                'default' => esc_html__('Hello World', 'elementor-widget'),
                'placeholder' => esc_html__('Enter your title', 'elementor-widget'),
            ]
        );

        $this->add_control(
            'description',
            [
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'label' => esc_html__('Description', 'elementor-widget'),
                'default' => esc_html__('this is a description', 'elementor-widget'),
                'placeholder' => esc_html__('Enter your description text', 'elementor-widget'),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'style_section_title',
            [
                'label' => esc_html__('Title', 'elementor-widget'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'desc_color',
            [
                'label' => esc_html__('Description Color', 'elementor-widget'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .discription' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'input',
            [
                'label' => esc_html__('Input Text', 'elementor-widget'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => esc_html__('Enter your title', 'elememtor-widget'),
            ]
        );
        $this->add_control(
            'image',
            [
                'label' => esc_html__('Choose Image', 'elementor-widget'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $this->end_controls_section();
    }

    public function render() {
        $settings = $this->get_settings_for_display();
        $args = [
            'post_status' => 'publish',
            'posts_per_page' => $settings['posts_limit'] ? $settings['posts_limit'] : 6,
            'post_type' => 'post',
            'orderby' => 'date',
            'order' => 'desc'

        ];
        $query = new \WP_Query($args);
?>
        <div class="ultimate-post-kit-container">
            <div class="ultimate-post-kit">
                <!-- Ultimate-woo-kit-style-1 -->
                <div class="ultimate-post-kit-fly-wrap">
                    <div class="upk-fly-grid-wrapper upk-fly-latout-1 upk-content-box-position-bottom-center">

                        <!-- GRID ITEM  -->
                        <?php
                        if ($query) {
                            while ($query->have_posts()) {
                                $query->the_post();
                                $image_src = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'medium');
                        ?>
                                <div class="upk-fly-grid-item">
                                    <div class="upk-fly-grid-item-box">
                                        <div class="upk-image-wrapper">
                                            <a href="<?php echo get_the_permalink(); ?>">
                                                <img class="upk-img" src="<?php echo $image_src[0]; ?>" alt="<?php echo get_the_title(); ?>">
                                            </a>
                                        </div>

                                        <div class="upk-fly-content-box">
                                            <div class="upk-content-inner">
                                                <a class="upk-fly-title" href="<?php echo get_the_permalink(); ?>">
                                                    <h3 class="upk-title"><?php echo get_the_title(); ?></h3>
                                                </a>
                                                <div class="upk-meta">
                                                    <div class="upk-date-content">
                                                        <span class="upk-date-text"><?php echo get_the_date(); ?></span>
                                                    </div>

                                                    <div class="upk-author-content">
                                                        <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" <strong><?php echo __('by', 'pure-grid-layout'); ?></strong>
                                                            <span class="upk-author"><?php echo get_the_author_meta('display_name'); ?></span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="upk-read-more-button">
                                                <a class="upk-btn" href="<?php echo get_the_permalink(); ?>"><i class="upk-btn-icon fas fa-plus"></i><?php echo __('read more', 'pure-grid-widget'); ?></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        <?php
                            }
                        };
                        ?>
                    </div>
                </div>
            </div>
        </div>
<?php
    }
}
