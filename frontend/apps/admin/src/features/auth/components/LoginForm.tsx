'use client';

import { z } from 'zod';
import { emailSchema } from '@lib/validation/email';
import { passwordSchema } from '@lib/validation/password';
import { useForm } from 'react-hook-form';
import { zodResolver } from '@hookform/resolvers/zod';
import { Input } from '@ui/components/ui/input';
import { Button } from '@ui/components/ui/button';
import { useLogin } from '@features/auth/hooks/use-login';
import { useState } from 'react';
import { Alert, AlertDescription, AlertTitle } from '@ui/components/ui/alert';
import { Field, FieldError, FieldGroup, FieldLabel } from '@ui/components/ui/field';

const FormSchema = z.object({
    email: emailSchema,
    password: passwordSchema,
});

export type LoginFormInput = z.infer<typeof FormSchema>;

export default function LoginForm() {
    const [globalError, setGlobalError] = useState<string | null>(null);
    const {
        register,
        handleSubmit,
        formState: { errors },
    } = useForm<LoginFormInput>({
        mode: 'onBlur',
        resolver: zodResolver(FormSchema),
    });
    const { login } = useLogin(setGlobalError);

    return (
        <>
            <form onSubmit={handleSubmit(login)}>
                {globalError && (
                    <Alert variant="destructive" className="mb-5">
                        <AlertTitle>Login Failed</AlertTitle>
                        <AlertDescription>{globalError}</AlertDescription>
                    </Alert>
                )}
                <FieldGroup>
                    <Field data-invalid={!!errors.email}>
                        <FieldLabel htmlFor="email">{'email'}</FieldLabel>
                        <Input
                            aria-invalid={!!errors.email}
                            id="email"
                            type="email"
                            placeholder={'email'}
                            {...register('email')}
                        />
                        <FieldError>{errors?.email?.message}</FieldError>
                    </Field>

                    <Field data-invalid={!!errors.password}>
                        <FieldLabel htmlFor="password">{'Password'}</FieldLabel>
                        <Input
                            aria-invalid={!!errors.password}
                            id="password"
                            type="password"
                            placeholder={'Password'}
                            {...register('password')}
                        />
                        <FieldError>{errors?.password?.message}</FieldError>
                    </Field>
                </FieldGroup>
                <Field className="mt-5">
                    <Button type="submit">{'Save'}</Button>
                </Field>
            </form>
        </>
    );
}
