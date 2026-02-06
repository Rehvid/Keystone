import { z } from 'zod';

export const emailSchema = z
    .email({
        error: 'email.invalid_format',
    })
    .trim()
    .toLowerCase();
