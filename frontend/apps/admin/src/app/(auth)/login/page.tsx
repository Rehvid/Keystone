'use client';

import LoginForm from '@features/auth/components/LoginForm';
import { Header } from '@ui/components/ui/header';

export default function Login() {
    return (
        <div className="max-w-xl flex flex-col flex-1 gap-4 px-4">
            <Header as={2} className="text-center">
                Zaloguj się
            </Header>

            <LoginForm />
        </div>
    );
}
