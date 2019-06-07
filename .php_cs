<?php
$finder = \PhpCsFixer\Finder::create()
    ->in(__DIR__);

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
        'increment_style' => false,
        'multiline_whitespace_before_semicolons' => [
            'strategy' => 'no_multi_line',
        ],
        'ordered_class_elements' => false,
        'phpdoc_annotation_without_dot' => false,
        'phpdoc_no_access' => false,
        'phpdoc_no_alias_tag' => false,
        'phpdoc_no_package' => false,
        'phpdoc_summary' => false,
        'phpdoc_to_comment' => false,
        'single_blank_line_before_namespace' => false,
        'single_line_comment_style' => false,
    ])
    ->setFinder($finder);
