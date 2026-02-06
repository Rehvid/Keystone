'use client';

import { BsBell } from 'react-icons/bs';
import { Button } from '@ui/components/ui/button';
import { useTranslation } from 'react-i18next';

export default function NavbarRight() {
    const { t } = useTranslation('common');
    return (
        <div className="flex items-center gap-8">
            <Button variant="ghost" size="icon" aria-label="Notifications">
                <BsBell />
            </Button>
            <div className="flex gap-2 items-center">
                <div>Avatar - PLACEHOLDER -test {t('save')}</div>
                <div className="hidden lg:flex lg:flex-col">
                    <span>Admin User - PLACEHOLDER</span>
                    <span>@adminuser.com - PLACEHOLDER</span>
                </div>
            </div>
        </div>
    );
}
