import { z } from 'zod';

export const PASSWORD_MIN_LENGTH = 2;
export const PASSWORD_REGEX = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_+\-=\\[\]{};':"\\|,.<>/?]).+$/;

export const passwordSchema = z
    .string()
    .min(PASSWORD_MIN_LENGTH, {
        error: 'password.min_length',
    })
    .regex(PASSWORD_REGEX, {
        error: 'password.invalid_format',
    });
