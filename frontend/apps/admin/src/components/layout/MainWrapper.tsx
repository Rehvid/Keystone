import Content from '@components/layout/Content';
import Navbar from '@components/layout/navbar/Navbar';

export default function MainWrapper({ children }: { children: React.ReactNode }) {
    return (
        <div className="flex flex-col w-full transition-margin duration-300">
            <Navbar />
            <Content>{children}</Content>
        </div>
    );
}
