<?php

/**
 * This file is part of the OpenPNE package.
 * (c) OpenPNE Project (http://www.openpne.jp/)
 *
 * For the full copyright and license information, please view the LICENSE
 * file and the NOTICE file that were distributed with this source code.
 */

/**
 * opWidgetFormDate represents a date widget.
 *
 * @package    OpenPNE
 * @subpackage widget
 * @author     Kousuke Ebihara <ebihara@tejimaya.com>
 */
class opWidgetFormDate extends sfWidgetFormI18nDate
{
  protected function configure($options = array(), $attributes = array())
  {
    parent::configure($options, $attributes);
    $this->setOption('can_be_empty', false);
  }

 /**
  * @see sfWidgetFormI18nDate
  */
  protected function getDateFormat($culture)
  {
    $result = parent::getDateFormat($culture);
    return str_replace('%year%', '%input_year%', $result);
  }

  /**
   * @see sfWidgetFormDate
   */
  public function render($name, $value = null, $attributes = array(), $errors = array())
  {
    if (is_array($value))
    {
      $value = sprintf('%04d-%02d-%02d', $value['year'], $value['month'], $value['day']);
    }

    $dateTime = new DateTime($value);
    if (!$dateTime)
    {
      throw new sfException('Invaid date format.');
    }

    $emptyValues = $this->getOption('empty_values');

    $days = $this->getOption('days');
    $months = $this->getOption('months');

    $dayDefault = $dateTime->format('j');
    $monthDefault = $dateTime->format('n');
    $year = $dateTime->format('Y');
    if ($this->getOption('can_be_empty'))
    {
      $days = array('' => $emptyValues['day']) + $days;
      $months = array('' => $emptyValues['month']) + $months;

      $dayDefault = $emptyValues['day'];
      $monthDefault = $emptyValues['month'];
      $year = $emptyValues['year'];
    }

    // days
    $widget = new sfWidgetFormSelect(array('choices' => $days), array_merge($this->attributes, $attributes));
    $date['%day%'] = $widget->render($name.'[day]', $dayDefault);

    // months
    $widget = new sfWidgetFormSelect(array('choices' => $months), array_merge($this->attributes, $attributes));
    $date['%month%'] = $widget->render($name.'[month]', $monthDefault);

    // years
    $attributes['size'] = '5';
    $widget = new sfWidgetFormInput(array(), array_merge(array('class' => 'input_text'), $this->attributes, $attributes));
    $date['%input_year%'] = $widget->render($name.'[year]', $year);

    return strtr($this->getOption('format'), $date);
  }
}