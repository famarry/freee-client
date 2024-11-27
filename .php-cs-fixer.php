<?php

ini_set('memory_limit', -1);

$finder = PhpCsFixer\Finder::create()
    ->notPath('bootstrap/cache')
    ->notPath('storage')
    ->notPath('vendor')
    ->in(__DIR__)
    ->name('*.php')
    ->ignoreDotFiles(true)
    ->ignoreVCS(true);

$fixers = [
    '@PSR2'                                       => true,
    'no_closing_tag'                              => true,
    'blank_line_after_opening_tag'                => true,
    'concat_space'                                => true,
    'no_multiline_whitespace_around_double_arrow' => true,
    'no_empty_statement'                          => true,
    'simplified_null_return'                      => true,
    'include'                                     => true,
    'no_alias_functions'                          => true,
    'no_trailing_comma_in_singleline'             => true,
    'trailing_comma_in_multiline'                 => true,
    'no_leading_namespace_whitespace'             => true,
    'linebreak_after_opening_tag'                 => true,
    'no_blank_lines_after_class_opening'          => true,
    'no_blank_lines_after_phpdoc'                 => true,
    'object_operator_without_whitespace'          => true,
    'phpdoc_indent'                               => true,
    'phpdoc_no_access'                            => true,
    'phpdoc_no_package'                           => true,
    'phpdoc_scalar'                               => true,
    'phpdoc_summary'                              => true,
    'phpdoc_to_comment'                           => true,
    'phpdoc_trim'                                 => true,
    'phpdoc_var_without_name'                     => true,
    'no_leading_import_slash'                     => true,
    'blank_line_before_statement'                 => ['statements' => ['return']],
    'function_typehint_space'                     => true,
    'no_unused_imports'                           => true,
    'ordered_imports'                             => true,
    'self_accessor'                               => true,
    'single_quote'                                => true,
    'no_singleline_whitespace_before_semicolons'  => true,
    'cast_spaces'                                 => true,
    'standardize_not_equals'                      => true,
    'ternary_operator_spaces'                     => true,
    'trim_array_spaces'                           => true,
    'binary_operator_spaces'                      => [
        'operators' => [
            '===' => 'align_single_space_minimal',
            '='   => 'align_single_space_minimal',
            '=>'  => 'align_single_space_minimal',
        ],
    ],
    'unary_operator_spaces'                  => true,
    'no_whitespace_in_blank_line'            => true,
    'multiline_whitespace_before_semicolons' => true,
    'array_syntax'                           => ['syntax' => 'short'],
    'lowercase_cast'                         => true,
    'native_function_casing'                 => true,
    'no_blank_lines_before_namespace'        => true,
    'no_empty_comment'                       => true,
    'no_empty_phpdoc'                        => true,
    'no_short_bool_cast'                     => true,
    'no_spaces_around_offset'                => true,
    'no_unneeded_control_parentheses'        => true,
    'no_whitespace_before_comma_in_array'    => true,
    'normalize_index_brace'                  => true,
    'phpdoc_align'                           => true,
    'phpdoc_separation'                      => true,
    'phpdoc_single_line_var_spacing'         => true,
    'phpdoc_types'                           => true,
    'return_type_declaration'                => true,
    'short_scalar_cast'                      => true,
    'whitespace_after_comma_in_array'        => true,
];

return (new PhpCsFixer\Config())
    ->setRules($fixers)
    ->setRiskyAllowed(true)
    ->setUsingCache(true)
    ->setFinder($finder);
