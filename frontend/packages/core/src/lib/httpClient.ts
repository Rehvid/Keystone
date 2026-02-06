import { AppPayload, BaseMeta } from '@core/types/api.types';

export enum HttpMethod {
    GET = 'GET',
    POST = 'POST',
    PUT = 'PUT',
    DELETE = 'DELETE',
    PATCH = 'PATCH',
}

export class ApiError<TMeta extends BaseMeta = BaseMeta> extends Error {
    constructor(
        public readonly payload: AppPayload<any, TMeta>,
        public readonly status: number,
    ) {
        super(payload.errorPayload?.message || 'API Error');
        this.name = 'ApiError';
    }
}

interface RequestOptions<TBody = any> {
    method: HttpMethod;
    body?: TBody;
    headers?: HeadersInit;
}

const API_URL = process.env.NEXT_PUBLIC_API_URL!;

export async function httpClient<TData = any, TMeta extends BaseMeta = BaseMeta, TBody = any>(
    path: string,
    options: RequestOptions<TBody>,
): Promise<AppPayload<TData, TMeta>> {
    const { headers, body, method } = options;

    const response = await fetch(`${API_URL}${path}`, {
        method,
        headers: {
            'Content-Type': 'application/json',
            ...headers,
        },
        credentials: 'include',
        body: body ? JSON.stringify(body) : undefined,
    });

    const payload: AppPayload<TData, TMeta> = await response.json();

    if (!response.ok) {
        throw new ApiError(payload, response.status);
    }

    return payload;
}
