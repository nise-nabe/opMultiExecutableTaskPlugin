<?php

/**
 * This file is part of the OpenPNE package.
 * (c) OpenPNE Project (http://www.openpne.jp/)
 *
 * For the full copyright and license information, please view the LICENSE
 * file and the NOTICE file that were distributed with this source code.
 */

/**
 * opMultiExecutableTaskBaseTask
 *
 * @package    opMultiExecutableTaskBaseTask
 * @subpackage task
 * @author     Yuya Watanabe <watanabe@tejimaya.com>
 */

abstract class opMultiExecutableTaskBaseTask extends sfBaseTask
{
  protected function configure()
  {
    $this->addOptions(array(
      new sfCommandOption('forked', null, sfCommandOption::PARAMETER_OPTIONAL, 'bool of fork', false)
    ));
  }

  protected function execute($arguments = array(), $options = array())
  {
    if (false == $options['forked'])
    {
      $php = opMultiExecutableTaskExec::findPhpBinary();
      for ($it = $this->nextOptions(); false !== ($forkedOption = $it());)
      {
        $output = array();
        $forkArguments = implode(' ', $arguments);
        $forkOptions = $this->optionsToString(array_merge($options, $forkedOption));

        $command = $php.' '.sfConfig::get('sf_root_dir').'/symfony  '.$forkArguments.' '.$forkOptions.' --forked=true';
        exec($command, &$output);
        foreach ($output as $line)
        {
          echo $line."\n";
        }
      }

      return;
    }

    unset($options['forked']);
  }

  private function optionsToString($options = array())
  {
    $result = array();
    foreach ($options as $key => $value)
    {
      if (!empty($value))
      {
        $result[] = '--'.$key.'='.$value;
      }
    }

    return implode(' ', $result);
  }

  /**
   * return options for iterate task
   * please return false if the end of task
   *
   * @return Array or false
   */
  protected abstract function nextOptions();
}
