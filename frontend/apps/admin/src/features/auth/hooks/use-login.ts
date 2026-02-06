import { useRouter } from 'next/navigation';
import { useApiRequest } from '@core/hooks/useApiRequest';
import { LoginFormInput } from '@features/auth/components/LoginForm';
import { authService } from '@features/auth/services/auth.service';
import { AppPayload, StatusPayload } from '@core/types/api.types';
import { ApiError } from '@core/lib/httpClient';
import React from 'react';

export function useLogin(setGlobalAlert: React.Dispatch<React.SetStateAction<string | null>>) {
    const router = useRouter();

    const login = async (data: LoginFormInput) => {
        return execute(() => authService.login(data));
    };

    const onSuccess = (payload: AppPayload<void>) => {
        if (payload.status.toUpperCase() === StatusPayload.SUCCESS_EMPTY) {
            router.replace('/dashboard');
        }
    };

    const onError = (error: ApiError) => {
        setGlobalAlert(error.payload.error?.code ?? 'auth_login_error');
    };

    const onNetworkError = () => {
        setGlobalAlert('common.network_error');
    };

    const { execute, loading } = useApiRequest<void>({
        onSuccess,
        onError,
        onNetworkError,
    });

    return { login, loading };
}
