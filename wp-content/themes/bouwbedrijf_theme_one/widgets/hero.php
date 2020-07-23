<?php

namespace WPC\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if (!defined('ABSPATH')) exit; // Exit if accessed directly


class Hero extends Widget_Base{

  public function get_name(){
    return 'hero';
  }

  public function get_title(){
    return 'Hero';
  }

  public function get_icon(){
    return 'fa fa-images';
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
      'title_hero',
      [
        'label' => 'Titel hero',
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => 'Bouwbedrijf de Vries'
      ]
    );

    $this->add_control(
      'content_hero',
      [
        'label' => 'Content',
        'type' => \Elementor\Controls_Manager::WYSIWYG,
        'default' => 'Schrijf een korte, krachtige beschrijving over uw bedrijf.'
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
    <div class="hero d-flex justify-content-center align-items-center">
      <div class="hero__overlay"></div>
      <div class="hero__box d-flex flex-column justify-content-center align-items-center">
        <h1><?php echo $settings['title_hero'] ?></h1>
        <p><?php echo $settings['content_hero'] ?></p>
        <div class="d-flex">
        </div>
      </div>
    </div>
    <?php
  }
}