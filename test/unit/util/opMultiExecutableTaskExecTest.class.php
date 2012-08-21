<?php

include(dirname(__FILE__).'/../../bootstrap/unit.php');

$t = new lime_test(null, new lime_output_color());

$php = opMultiExecutableTaskExec::findPhpBinary();

$output = array();
$returnVar = 0;

exec($php.' -v', &$output, &$returnVar);

$t->is($returnVar, 0);
