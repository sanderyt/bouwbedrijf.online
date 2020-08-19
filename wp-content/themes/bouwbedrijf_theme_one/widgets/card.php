<?php

namespace WPC\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if (!defined('ABSPATH')) exit; // Exit if accessed directly


class Card extends Widget_Base{

  public function get_name(){
    return 'card';
  }

  public function get_title(){
    return 'Service Card';
  }

  public function get_icon(){
    return 'fa fa-tools';
  }

  public function get_categories(){
    return ['basic'];
  }

  protected function _register_controls(){

    $this->start_controls_section(
      'section_content',
      [
        'label' => 'Settings',
      ]
    );

    $this->add_control(
      'label_heading',
      [
        'label' => 'Dienst',
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => 'Timmerwerk'
      ]
    );

    $this->add_control(
			'icon',
			[
				'label' => __( 'Icoontje dienst', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::ICON,
				'default' => 'fa fa-paint-brush',
			]
    );
    
    $this->add_control(
			'website_link',
			[
				'label' => __( 'Link', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'plugin-domain' ),
				'show_external' => true,
				'default' => [
					'url' => '',
					'is_external' => false,
					'nofollow' => true,
				],
			]
    );
    
    $this->add_control(
			'image',
			[
				'label' => __( 'Kies een afbeelding', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);


    $this->end_controls_section();
  }
  

  protected function render(){
    $settings = $this->get_settings_for_display();

    $this->add_inline_editing_attributes('label_heading', 'basic');
    $this->add_render_attribute(
      'label_heading',
      [
        'class' => ['advertisement__label-heading'],
      ]
    );

    ?>
    <a href="<?php echo $settings['website_link']['url'] ?>">
    <div class="service-card">
      <div class="service-card__icon d-flex justify-content-center align-items-center"><i class="<?php echo $settings['icon'] ?>"></i></div>
      <div class="service-card__thumb">
        <img src="<?php echo $settings['image']['url'] ?>" />
      </div>
      <div class="service-card__title d-flex justify-content-center align-items-center">
        <h3><?php echo $settings['label_heading'] ?></h3>
      </div>
    </div>
    </a>
    <?php
  }
}