import NavbarLeft from '@components/layout/navbar/NavbarLeft';
import NavbarRight from '@components/layout/navbar/NavbarRight';

export default function Navbar() {
    return (
        <nav className="bg-white h-16 px-4">
            <header className="flex items-center justify-between h-full">
                <NavbarLeft />
                <NavbarRight />
            </header>
        </nav>
    );
}
