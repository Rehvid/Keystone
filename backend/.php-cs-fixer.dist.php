<?php

$finder = (new PhpCsFixer\Finder())
    ->in(__DIR__)
    ->exclude(['var', 'vendor', 'migrations'])
;

return (new PhpCsFixer\Config())
    ->setRules([
        '@PSR12' => true,
        '@Symfony' => true,
        '@PHP84Migration' => true,
        'strict_param' => true,
        'array_syntax' => ['syntax' => 'short'],
        'array_indentation' => true,
        'method_chaining_indentation' => true,
        'single_quote' => true,
        'no_useless_else' => true,
        'no_useless_return' => true,
        'no_empty_comment' => true,
        'compact_nullable_type_declaration' => true,
        'declare_strict_types' => true,
        'ordered_imports' => ['sort_algorithm' => 'alpha'],
        'no_unused_imports' => true,
        'trailing_comma_in_multiline' => [
            'elements' => ['arrays', 'arguments', 'parameters', 'match']
        ],
        'concat_space' => ['spacing' => 'one'],
        'multiline_whitespace_before_semicolons' => ['strategy' => 'no_multi_line'],
    ])
    ->setFinder($finder)
    ;
