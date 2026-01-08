import tsParser from '@typescript-eslint/parser';
import tsPlugin from '@typescript-eslint/eslint-plugin';
import prettierPlugin from 'eslint-plugin-prettier';
import pluginReact from 'eslint-plugin-react';
import pluginPrettier from 'eslint-plugin-prettier';

export default [
    {
        files: ['src/**/*.{ts,tsx,js,jsx}'],
        ignores: ['node_modules', '.next', 'out', 'dist'],
        languageOptions: {
            parser: tsParser,
            parserOptions: {
                ecmaVersion: 2025,
                sourceType: 'module',
                ecmaFeatures: { jsx: true },
            },
        },
        plugins: {
            '@typescript-eslint': tsPlugin,
            react: pluginReact,
            prettier: prettierPlugin,
        },
        rules: {
            // Prettier
            'prettier/prettier': [
                'error',
                {
                    printWidth: 120,
                    tabWidth: 4,
                    useTabs: false,
                    semi: true,
                    singleQuote: true,
                    trailingComma: 'all',
                    bracketSpacing: true,
                    arrowParens: 'always',
                },
            ],

            // JavaScript / TypeScript
            'no-unused-vars': 'off',
            '@typescript-eslint/no-unused-vars': [
                'warn',
                {
                    argsIgnorePattern: '^_',
                    varsIgnorePattern: '^(?:_|Metadata|AnotherType)$',
                    ignoreRestSiblings: true,
                },
            ],
            'no-undef': 'off',
            'no-debugger': 'error',
            'prefer-const': 'warn',
            'no-unneeded-ternary': 'warn',
            'no-nested-ternary': 'warn',
            'prefer-arrow-callback': 'warn',
            'arrow-spacing': ['warn', { before: true, after: true }],
            eqeqeq: ['error', 'always'],
            'no-shadow': 'warn',
            'consistent-return': 'error',
            'no-param-reassign': ['error', { props: true }],
            'no-empty-function': 'warn',
            'no-useless-catch': 'warn',
            'object-shorthand': ['warn', 'always'],
            curly: ['error', 'all'],

            // React
            'react/jsx-uses-react': 'off',
            'react/react-in-jsx-scope': 'off',
            'react/jsx-uses-vars': 'error',
            'react/prop-types': 'off',
        },
        settings: {
            'import/resolver': {
                typescript: {
                    alwaysTryTypes: true,
                    project: ['./tsconfig.base.json'],
                },
            },
        },
    },
];
