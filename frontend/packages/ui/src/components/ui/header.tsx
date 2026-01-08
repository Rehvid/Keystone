import { ElementType, ReactNode } from 'react';
import { cn } from '@ui/lib/utils';

type HeadingLevel = 1 | 2 | 3 | 4 | 5 | 6;

type HeaderProps = {
    as?: HeadingLevel;
    variant?: HeadingLevel;
    children: ReactNode;
    className?: string;
};

const variants: Record<HeadingLevel, string> = {
    1: 'text-4xl font-bold',
    2: 'text-3xl font-semibold',
    3: 'text-2xl font-semibold',
    4: 'text-xl font-medium',
    5: 'text-lg font-medium',
    6: 'text-base font-medium',
};

export function Header({ as = 2, variant = as, children, className }: HeaderProps) {
    const Tag = `h${as}` as ElementType;
    return <Tag className={cn(variants[variant], className)}>{children}</Tag>;
}
