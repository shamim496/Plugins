<?php
class Layout_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'post-widget';
    }

    public function get_title() {
        return esc_html__('Post Layout', 'elementor-widget');
    }

    public function get_icon() {
        return 'eicon-pojome';
    }

    public function get_categories() {
        return ['basic'];
    }

    public function get_keyeords() {
        return ['post', 'layout'];
    }

    public function register_controls() {
        $this->start_controls_section(
            'content_section_title',
            [
                'label' => esc_html__('Title', 'post-layout'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'title',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label' => esc_html__('Title', 'post-layout'),
                'default' => esc_html__('Hello World', 'post-layout'),
                'placeholder' => esc_html__('Enter your title', 'post-layout'),
            ]
        );

        $this->add_control(
            'description',
            [
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'label' => esc_html__('Description', 'post-layout'),
                'default' => esc_html__('this is a description', 'post-layout'),
                'placeholder' => esc_html__('Enter your description text', 'post-layout'),
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'style_section_title',
            [
                'label' => esc_html__('Title', 'post-layout'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'input',
            [
                'label' => esc_html__('Input Text', 'post-layout'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => esc_html__('Enter your title', 'post-layout'),
            ]
        );
        $this->add_control(
            'image',
            [
                'label' => esc_html__('Choose Image', 'post-layout'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $this->add_control(
            'post_limit',
            [
                'label' => esc_html__('Post Limit', 'post-layout'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 6,
            ]
        );

        $this->add_control(
            'posts_order',
            [
                'label' => esc_html__('Post Limit', 'post-layout'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'asc' => __('Ascending', 'post-layout'),
                    'desc' => __('Descending', 'post-layout')
                ],
                'default' => 'desc',
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Title Color', 'post-layout'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .upk-alice-grid .upk-alice-grid-wrapper .upk-alice-grid-item .upk-alice-item-box .upk-alice-content-box .upk-alice-title-wrap .upk-alice-title' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'author_color',
            [
                'label' => esc_html__('Author Color', 'post-layout'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .upk-alice-grid .upk-alice-grid-wrapper .upk-alice-grid-item .upk-alice-item-box .upk-alice-content-box .upk-alice-meta .upk-alice-author a' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_section();
    }
    public function render() {
        $settings = $this->get_settings_for_display();
        $args = [
            'post_status' => 'publish',
            'post_per_page' => $settings['post_limit'],
            'post_type' => 'post',
            'orderby' => 'title',
            'order' => $settings['posts_order'],
        ];

        $query = new \WP_Query($args);

?>
        <div class="ultimate-post-kit-container">
            <div class="upk-alice-grid">
                <div class="upk-alice-grid-wrapper upk-alice-grid-layout-1 upk-content-position-bottom-center">

                    <!-- POST GRID LAYOUT -->
                    <?php
                    if ($query) {
                        while ($query->have_posts()) {
                            $query->the_post();
                            $image_src = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'medium');
                    ?>
                            <div class="upk-alice-grid-item">
                                <div class="upk-alice-item-box">
                                    <div class="upk-alice-image-wrapper">
                                        <img class="upk-alice-img" src="<?php echo $image_src['0']; ?>" alt="<?php echo get_the_title(); ?>">
                                    </div>
                                    <div class="upk-alice-category">
                                        <a href="<?php echo get_the_permalink(); ?>" rel="category tag"><?php ?></a>
                                    </div>
                                    <div class="upk-alice-content-box">
                                        <h2 class="upk-alice-title-wrap">
                                            <?php printf('<a href="%1$s"class="upk-alice-title" title="%2$s">%2$s</a>', get_the_permalink(), get_the_title()); ?>
                                        </h2>

                                        <div class="upk-alice-meta">
                                            <div class="upk-alice-author">
                                                
                                                <span>by</span>
                                                <a href="<?php echo get_the_permalink(); ?>">
                                                    <?php echo get_the_author_meta('display_name'); ?>
                                                </a>
                                            </div>

                                            <div class="upk-alice-date">
                                                <?php echo get_the_date(); ?>
                                            </div>
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
<?php
    }
}
