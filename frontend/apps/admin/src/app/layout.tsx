'use client';

import './globals.css';
import React from 'react';

export default function RootLayout({
    children,
}: Readonly<{
    children: React.ReactNode;
}>) {
    return (
        <html lang="pl">
            <body className={`antialiased`}>{children}</body>
        </html>
    );
}
