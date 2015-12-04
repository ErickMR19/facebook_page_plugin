<?php

/**
 * @file
 * Contains Drupal\facebook_page_plugin\Plugin\Block\FBPageBlock.
 */

namespace Drupal\facebook_page_plugin\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a 'FBPageBlock' block.
 *
 * @Block(
 *  id = "fbpage_block",
 *  admin_label = @Translation("Facebook Page Block"),
 * )
 */
class FBPageBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {
    $form['fb-url'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Escriba el url de la pagina'),
      '#description' => $this->t('URL of the Facebook Page'),
      '#default_value' => isset($this->configuration['fb-url']) ? $this->configuration['fb-url'] : 'https://www.facebook.com/',
      '#maxlength' => 200,
    );
    $form['width'] = array(
      '#type' => 'number',
      '#title' => $this->t('Width'),
      '#description' => $this->t('The pixel width of the plugin'),
      '#default_value' => isset($this->configuration['width']) ? $this->configuration['width'] : 340,
      '#maxlength' => 200,
    );
    $form['height'] = array(
      '#type' => 'number',
      '#title' => $this->t('Height'),
      '#description' => $this->t('The pixel height of the plugin'),
      '#default_value' => isset($this->configuration['height']) ? $this->configuration['height'] : 500,
      '#maxlength' => 200,
    );
    $form['hide-cover'] = array(
      '#type' => 'checkbox',
      '#title' => $this->t('Hide cover photo'),
      '#description' => $this->t('Hide cover photo in the header'),
      '#default_value' => isset($this->configuration['hide-cover']) ? $this->configuration['hide-cover'] : '',
    );
    $form['show-facepile'] = array(
      '#type' => 'checkbox',
      '#title' => $this->t('Show frinds\' profile photo'),
      '#description' => $this->t('Show profile photos when friends like this'),
      '#default_value' => isset($this->configuration['show-facepile']) ? $this->configuration['show-facepile'] : '',
    );
    $form['show-posts'] = array(
      '#type' => 'checkbox',
      '#title' => $this->t('Show recent posts'),
      '#description' => $this->t("Show posts from the Page's timeline"),
      '#default_value' => isset($this->configuration['show-posts']) ? $this->configuration['show-posts'] : '',
    );
    $form['hide-cta'] = array(
      '#type' => 'checkbox',
      '#title' => $this->t('Hide custom call'),
      '#description' => $this->t('Hide the custom call to action button'),
      '#default_value' => isset($this->configuration['hide-cta']) ? $this->configuration['hide-cta'] : '',
    );
    $form['small-header'] = array(
      '#type' => 'checkbox',
      '#title' => $this->t('Small header'),
      '#description' => $this->t('Use the small header instead'),
      '#default_value' => isset($this->configuration['small-header']) ? $this->configuration['small-header'] : '',
    );
    $form['adapt-container-width'] = array(
      '#type' => 'checkbox',
      '#title' => $this->t('Responsive'),
      '#description' => $this->t('Try to fit inside the container width'),
      '#default_value' => isset($this->configuration['adapt-container-width']) ? $this->configuration['adapt-container-width'] : '',
    );

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    $this->configuration['fb-url'] = $form_state->getValue('fb-url');
    $this->configuration['width'] = $form_state->getValue('width');
    $this->configuration['height'] = $form_state->getValue('height');
    $this->configuration['hide-cover'] = $form_state->getValue('hide-cover');
    $this->configuration['show-facepile'] = $form_state->getValue('show-facepile');
    $this->configuration['show-posts'] = $form_state->getValue('show-posts');
    $this->configuration['hide-cta'] = $form_state->getValue('hide-cta');
    $this->configuration['small-header'] = $form_state->getValue('small-header');
    $this->configuration['adapt-container-width'] = $form_state->getValue('adapt-container-width');
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    $estados = ['false','true'];
    $build = [];
    $build['#attached']['library'][] = 'facebook_page_plugin/facebook_page_plugin.facebook_js_sdk';


    $build['fbpage_block_direccion_web_pagina2']['#markup'] =
    "<div class='fb-page'
          data-href='{$this->configuration['fb-url']}'
          data-width='{$this->configuration['width']}'
          data-height='{$this->configuration['height']}'
          data-hide-cover='{$estados[$this->configuration['hide-cover']]}'
          data-show-facepile='{$estados[$this->configuration['show-facepile']]}'
          data-show-posts='{$estados[$this->configuration['show-posts']]}'
          data-hide-cta='{$estados[$this->configuration['hide-cta']]}'
          data-small-header='{$estados[$this->configuration['small-header']]}'
          data-adapt-container-width='{$estados[$this->configuration['adapt-container-width']]}'>
    </div>";

    return $build;
  }

}
