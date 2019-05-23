<?php
$finder = \PhpCsFixer\Finder::create()
    ->in(__DIR__)
;

return \PhpCsFixer\Config::create()
    ->setRules([
        '@PhpCsFixer' => true,
        'blank_line_after_opening_tag' => false,
        'braces' => [
            'position_after_functions_and_oop_constructs' => 'same',
        ],
        'concat_space' => [
            'spacing' => 'one',
        ],
        'single_blank_line_before_namespace' => false,
    ])
    ->setFinder($finder)
;
