<?php
class Second_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'second-widget';
    }

    public function get_title() {
        return esc_html__('Second Widget', 'elementor-widget');
    }

    public function get_icon() {
        return 'eicon-pojome';
    }

    public function get_categories() {
        return ['general'];
    }

    public function get_keywords() {
        return ['shamim'];
    }

    public function register_controls() {
        $this->start_controls_section(
            'content_section_title',
            [
                'label' => esc_html__('Title', 'elementor-widget'),
                'lab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'title',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label' => esc_html__('Title', 'elementor-widget'),
                'default' => esc_html__('Hello world', 'elementor-widget'),
                'placeholder' => esc_html__('Enter your tilte', 'elementor-widget'),
            ]
        );
        $this->add_control(
            'description',
            [
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'label' => esc_html__('Description', 'elementor-widget'),
                'default' => esc_html__('this is description', 'elementor-widget'),
                'placeholder' => esc_html__('Enter your description', 'elementor-widget'),
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
            'title_color',
            [
                'label' => esc_html__('Title Color', 'elementor-widget'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .title' => 'color: {{VALUE}}',
                ],
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

        $args = [
            'post_status' => 'publish',
            'post_per_page' => 2,
            'post_type' => 'post',
            'orderby' => 'date',
            'order' => 'desc',
        ];
        $query = new \WP_Query($args);
?>

        <section class="uk-section uk-section-default uk-section-large">
            <div class="uk-container uk-container-medium">
                <div class="uk-grid uk-grid-small uk-child-width-1-2@m" uk-grid>

                    <?php
                    if ($query) {
                        while ($query->have_posts()) {
                            $query->the_post();
                            $image_src = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'large');
                    ?>


                            <div class="">
                                <div class="uk-grid uk-grid-small">
                                    <div class="bdt-post-list-wrapper">
                                        <img class="bdt-post-list-img" src="<?php echo $image_src[0]; ?>"> alt = "<?php echo get_the_title(); ?>">
                                    </div>
                                    <div class="bdt-post-list-content">
                                        <h4 class="bdt-post-list-title">
                                            <?php echo get_the_title(); ?>
                                        </h4>
                                        <div class="uk-text-meta bdt-post-list-button">
                                            <span class="date"><?php echo get_the_date(); ?></span>
                                            <span class="meta">Company updates</span>
                                        </div>
                                    </div>
                                </div>
                                <hr class="uk-margin-medium-top">
                            </div>
                    <?php
                        }
                    }; ?>
                </div>
            </div>
        </section>
    <?php
    }
}
