import { LoginFormInput } from '@features/auth/components/LoginForm';
import { httpClient, HttpMethod } from '@core/lib/httpClient';
import { AppPayload, BaseMeta } from '@core/types/api.types';

export const authService = {
    async login(data: LoginFormInput): Promise<AppPayload<void>> {
        return httpClient<void, BaseMeta, LoginFormInput>('api/v1/security/token', {
            method: HttpMethod.POST,
            body: data,
        });
    },
};
