import type { NextConfig } from 'next';
import path from 'path';
const { i18n } = require('./next-i18next.config');

const nextConfig: NextConfig = {
    i18n,
    webpack: (config) => {
        config.resolve.alias = {
            ...(config.resolve.alias || {}),
            '@ui': path.resolve(__dirname, '../../packages/ui/src'),
            '@core': path.resolve(__dirname, '../../packages/core/src'),
        };

        return config;
    },
};

export default nextConfig;
