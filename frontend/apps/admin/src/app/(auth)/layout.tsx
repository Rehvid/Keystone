import React from 'react';

export default function AuthLayout({ children }: { children: React.ReactNode }) {
    return (
        <main className="w-full flex">
            <section className="flex-1 hidden items-center justify-center h-screen bg-gray-900 lg:flex"></section>
            <section className="flex-1 flex items-center justify-center h-screen bg-white">{children}</section>
        </main>
    );
}
