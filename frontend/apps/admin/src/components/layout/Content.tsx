import { ReactNode } from 'react';

type AdminHeaderProps = {
    children: ReactNode;
};

export default function Content({ children }: AdminHeaderProps) {
    return <main className="bg-gray-100 flex-1 p-5">{children}</main>;
}
