<?php
$date = date('Y');
$header = <<<EOF
@copyright  trilobit GmbH
@author     trilobit GmbH <https://github.com/trilobit-gmbh>
@license    LGPL-3.0-or-later
EOF;

$config = new \PhpCsFixer\Config();

return $config
    ->setRiskyAllowed(true)
    ->setRules([
        // https://github.com/FriendsOfPHP/PHP-CS-Fixer/blob/master/doc/rules/index.rst

        '@Symfony' => true,
        '@Symfony:risky' => true,
        '@DoctrineAnnotation' => true,

        // Alias
        // Array Notation
        // Basic
        // Casing
        // Cast Notation
        // Class Notation
        'self_static_accessor' => true,
        // Class Usage
        // Comment
        'header_comment' => [
            'header' => $header,
            'comment_type' => 'comment',
            'location' => 'after_declare_strict',
        ],
        'comment_to_phpdoc' => [
            'ignored_tags' => [
                'todo'
            ],
        ],
        'multiline_comment_opening_closing' => true,
        'no_empty_comment' => true,
        // Constant Notation
        // Control Structure
        'no_useless_else' => true,
        'simplified_if_return' => true,
        // Doctrine Annotation
        // Function Notation
        'no_unreachable_default_argument_value' => true,
        'function_declaration' => [
            'closure_function_spacing' => 'none',
        ],
        'native_function_invocation' => [
            'include' => ['@compiler_optimized'],
            'scope' => 'namespaced',
            'strict' => true,
        ],
        'no_useless_sprintf' => true,
        'nullable_type_declaration_for_default_null_value' => true,
        'phpdoc_to_param_type' => true,
        'return_type_declaration' => true,
        'single_line_throw' => true,
        'static_lambda' => true,
        // Import
        // Language Construct
        'combine_consecutive_unsets' => true,
        'declare_parentheses' => true,
        'explicit_indirect_variable' => true,
        // List Notation
        // Namespace Notation
        // Naming
        // Operator
        // PHP Tag
        'echo_tag_syntax' => [
            'format' => 'short'
        ],
        // PHPUnit
        // PHPDoc
        'align_multiline_comment' => true,
        'phpdoc_add_missing_param_annotation' => true,
        'phpdoc_no_empty_return' => true,
        'phpdoc_order_by_value' => true,
        'phpdoc_order' => true,
        'phpdoc_tag_casing' => true,
        'phpdoc_var_annotation_correct_order' => true,
        // Return Notation
        'no_useless_return' => true,
        'return_assignment' => true,
        'simplified_null_return' => true,
        // Semicolon
        'multiline_whitespace_before_semicolons' => [
            'strategy' => 'new_line_for_chained_calls',
        ],
        // Strict
        'declare_strict_types' => true,
        'strict_comparison' => true,
        'strict_param' => true,
        // String Notation
        'heredoc_to_nowdoc' => true,
        'single_quote' => true,
        'string_length_to_empty' => true,
    ])
    ->setFinder(
        PhpCsFixer\Finder::create()
            ->exclude('trilobit')
            ->in([
                __DIR__.'/src'
            ])
    )
    ;
