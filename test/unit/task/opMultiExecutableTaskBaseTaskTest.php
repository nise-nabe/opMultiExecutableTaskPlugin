<?php

include(dirname(__FILE__).'/../../bootstrap/unit.php');

$t = new lime_test(null, new lime_output_color());

class TestTask extends opMultiExecutableTaskBaseTask
{
  protected function nextOptions()
  {
  }
}
