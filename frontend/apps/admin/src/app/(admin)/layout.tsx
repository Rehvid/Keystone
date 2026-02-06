import { ReactNode } from 'react';
import { SidebarProvider } from '@ui/components/ui/sidebar';
import AppSidebar from '@components/layout/sidebar/AppSidebar';
import MainWrapper from '@components/layout/MainWrapper';

export default function AdminLayout({ children }: { children: ReactNode }) {
    return (
        <SidebarProvider>
            <AppSidebar />
            <main className="min-h-screen flex w-full">
                <MainWrapper>{children}</MainWrapper>
            </main>
        </SidebarProvider>
    );
}
