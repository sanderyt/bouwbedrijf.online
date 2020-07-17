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
        'label' => 'Label Heading',
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => 'My Example Heading'
      ]
    );

    $this->add_control(
      'content_heading',
      [
        'label' => 'Content Heading',
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => 'My Other Example Heading'
      ]
    );

    $this->add_control(
      'content',
      [
        'label' => 'Content',
        'type' => \Elementor\Controls_Manager::WYSIWYG,
        'default' => 'Some example content. Start Editing Here.'
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
    <div class="service-card">
      <div class="service-card__icon d-flex justify-content-center align-items-center"><i class="fas fa-hammer"></i></div>
      <div class="service-card__thumb">
        <img src="https://www.debouwcombinatienc.nl/wp-content/uploads/2018/12/aanbouw.jpg" />
      </div>
      <div class="service-card__title d-flex justify-content-center align-items-center">
        <h3><?php echo $settings['label_heading'] ?></h3>
      </div>
    </div>
    <?php
  }
}