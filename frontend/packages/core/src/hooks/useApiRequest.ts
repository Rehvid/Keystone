import { useState, useCallback } from 'react';
import { AppPayload, BaseMeta } from '@core/types/api.types';
import { ApiError } from '@core/lib/httpClient';

interface UseApiRequestOptions<TData> {
    onSuccess?: (payload: AppPayload<TData>) => void;
    onError?: (error: ApiError) => void;
    onNetworkError?: (error: unknown) => void;
}

export function useApiRequest<TData = any, TMeta extends BaseMeta = BaseMeta>(
    options: UseApiRequestOptions<TData> = {},
) {
    const { onSuccess, onError, onNetworkError } = options;

    const [loading, setLoading] = useState(false);

    const execute = useCallback(
        async (serviceCall: () => Promise<AppPayload<TData, TMeta>>): Promise<AppPayload<TData, TMeta> | null> => {
            setLoading(true);

            try {
                const payload = await serviceCall();
                onSuccess?.(payload);

                return payload;
            } catch (error) {
                if (error instanceof ApiError) {
                    onError?.(error);
                } else {
                    onNetworkError?.(error);
                }
                return null;
            } finally {
                setLoading(false);
            }
        },
        [onSuccess, onError, onNetworkError],
    );

    return { execute, loading };
}
