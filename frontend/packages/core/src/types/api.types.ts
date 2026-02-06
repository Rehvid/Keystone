export enum StatusPayload {
    SUCCESS_EMPTY = 'SUCCESS_EMPTY',
    SUCCESS = 'SUCCESS',
    ERROR = 'ERROR',
}

export interface BaseMeta {
    requestId: string;
    timestamp: string;
}

export interface ErrorDetail {
    code: string;
    message: string;
    path?: string;
    details?: Record<string, any>;
}

export interface ErrorPayload {
    code: string;
    message: string;
    details: ErrorDetail[];
}

export interface AppPayload<TData = any, TMeta extends BaseMeta = BaseMeta> {
    status: StatusPayload;
    meta: TMeta;
    data?: TData | null;
    errorPayload?: ErrorPayload | null;
}
