import { SidebarTrigger } from '@ui/components/ui/sidebar';

export default function NavbarLeft() {
    return (
        <div className="flex gap-16">
            <SidebarTrigger />
            <div className="hidden lg:block ">Logo - PLACEHOLDER</div>
            <div className="hidden lg:block">
                <input type="search" defaultValue="SEARCH - PLACEHOLDER" />
            </div>
        </div>
    );
}
